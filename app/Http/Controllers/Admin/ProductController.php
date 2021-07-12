<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use Validator;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Http\Requests;

use App\Product;

use App\Category;

use App\Rate;

use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //mencari semua data produk
        $products = Product::all();
        //kembali ke view dengan passing data-data produk tersebut
        return view('Product.product',['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //membuat halaman create produk//

        //membuat option-option berdasarkan semua data category 
        $option = Category::lists('name', 'id');
        //mengawali option dengan 'select a value'
        $option->prepend('select a value', 0);
        //kembali ke view dengan passing dropdown category
        return view ('Product.add_product', ['genres' => $option]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //mem-validasi data-data produk yang ingin disimpan
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'numeric|min:1',
            'release_date' => 'date',
            'genre' => 'required|not_in:0',
            'file' => 'required|image'
        ]);
        //jika validasi gagal maka akan di redirect dengan error msg dan inputan sebelumnya
        if ($validator->fails()) {
            return redirect('product/add')
                ->withErrors($validator)
                ->withInput();
        }
        //mengambil request file
        $image = $request->file('file');
        //membuat nama file baru dengan di awali oleh waktu sekarang lalu disertai dengan ekstensi filenya
        $img = time().'.'.$image->getClientOriginalExtension();
        //standarisasi path penyimpanan file yang diupload
        $destinationPath = public_path('/images');
        //pindahkan file yang diupload ke path tersebut
        $image->move($destinationPath, $img);
        
        //simpan produk baru dengan data-data yang telah divalidasi
        $produk = new Product();
        $produk->name = $request['name'];
        $produk->price = $request['price'];
        $produk->category_id = $request['genre'];
        //penyimpanan release_data berdasarkan format tanggal Year-month-day
        $produk->release_date = date("Y-m-d", strtotime($request['release_date']));
        $produk->desc = trim($request['desc']);
        $produk->picture = $img;
        $produk->save();

        //kembali ke produk dengan pesan
        return redirect('/product')->with('message','Create user: '.$produk->name.' successfull');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        //untuk menampilkan detail produk//

        //menerima slug nama produk, maka harus direplace (-) menjadi ' ' agar nama produk sesuai nama yang ada di db
        $slug = str_replace('-', ' ', strtolower($slug));
        //lakukan pencarian terhadap nama tersebut
        $product = Product::where('name', '=', $slug)->first();
        //sertakan rata-rata rate produk yang dicari
        $product->rate = $product->rate_calc($product->id);

        //kembali ke view dengan mem-passing data-data detail produk
        return view('Product.detail_product',['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //mencari data-produk berdasarkan id nya//

        $product = Product::find($id);
        
        //membuat option category
        $option = Category::lists('name', 'id');
        
        //mengawali option dengan nilai default
        $option->prepend('select a value', 0);

        //kembali ke view dengan passing data produk yang ingin di edit serta dropdown genre pilihan yang ada
        return view('Product.edit_product', ['product' => $product, 'genres' => $option]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //mem-validasi data-data inputan untuk memperbaharui produk
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'numeric|min:1',
            'release_date' => 'date',
            'genre' => 'required|not_in:0',
            'file' => 'image|mimes:jpeg,bmp,png|max:2000'
        ]);

        //apabila validasi gagal maka akan di redirect dengan passing error msg dan inputan sebelumnya
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        //mengambil request file
        $image = $request->file('file');
        //membuat nama file baru dengan di awali oleh waktu sekarang lalu disertai dengan ekstensi filenya
        $img = time().'.'.$image->getClientOriginalExtension();
        //standarisasi path penyimpanan file yang diupload
        $destinationPath = public_path('/images');
        //pindahkan file yang diupload ke path tersebut
        $image->move($destinationPath, $img);
        
        //perbaharui produk baru dengan data-data yang telah divalidasi
        $product = Product::find($id);
        $product->name = $request['name'];
        $product->price = $request['price'];
        $product->release_date = date("Y-m-d", strtotime($request['release_date']));
        $product->category_id = $request['genre'];
        $product->picture = $img;
        $product->desc = trim($request['desc']);
        $product->save();
        //kembali ke view dengan pesan
        return redirect('/product')->with('message','Update product: '.$product->name.' successfull');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //penghapusan data produk berdasarkan id produk yang di passing
        $product = Product::find($id);
        $product->delete();
        //kembali ke view dengan pesan
        return redirect('/product')->with('message','Delete product: '.$product->name.' successfull');
    }
    /*
     * User Rating
     * */
    public function rate(Request $request, $id)
    {
        $is_exists = -1;
        //cek apakah user login sudah melakukan rating terhadap suatu produk
        $product = DB::select('           select COALESCE (r.id,-1)
                                          from products p
                                          join rates r on (p.id = r.product_id)
                                          join users u on (u.id = r.user_id)
                                          where p.id = :p_id and u.id = :u_id',['p_id'=> $id, 'u_id'=>Auth::id()]);
        foreach ($product as $rt){
            foreach ($rt as $r){
                $is_exists = $r;
            }
        }

        //apabila telah melakukan rating maka rate berikutnya dianggap sebagai pembaharuan terhadap rating produk tersebut
        if ($is_exists != -1){
            $rate = Rate::find($is_exists)->first();
            $rate->rate = $request['rate_product'];
            $rate->save();
            return redirect()->back()->with('message','You has been update your rate.');
        }
        //apabila belum melakukan rating sebelumnya, maka dibuat data data baru berdasarkan produk id yang di rate, user login serta jumlah rate yang diberikan
        else{
            $rate_product = new Rate();
            $rate_product->user_id = Auth::id();
            $rate_product->product_id = $id;
            $rate_product->rate = $request['rate_product'];
            $rate_product->save();
            //kembali ke view dengan pesan
            return redirect()->back()->with('message','Success rate the game.');
        }
    }
}

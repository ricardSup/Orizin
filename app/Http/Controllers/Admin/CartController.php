<?php

namespace App\Http\Controllers\Admin;

use App\Cart_item;

use App\Http\Controllers\Controller;

use App\Product;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;

use App\Cart;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //mengambil semua data produk yang ada di cart cart
        $cart_item = DB::select("
            select ci.id as ci_id, ci.product_id as p_id, p.price as p_harga, p.desc as p_desc, ci.qty as p_qty, p.picture, REPLACE(LOWER(p.name),' ','-') as slug, p.name, cat.name as p_c_name
            from carts c
            join cart_items ci on(c.id = ci.cart_id)
            join products p on(ci.product_id = p.id)
            join categories cat on(p.category_id = cat.id)
            where c.user_id = :u_id and c.status = 0", ['u_id'=>Auth::id()]);
        
        //mengambil data total cost, total qty pada cart user
        $cart = collect(DB::select('
            select c.id, c.total_cost, sum(ci.qty) as total_qty
            from carts c
            join cart_items ci on(c.id = ci.cart_id)
            where c.user_id = :u_id and c.status = 0
            group by c.id, c.total_cost', ['u_id'=>Auth::id()]))->first();

        //menampilkan view cart dengan mempassing data item cart serta data cart
        return view('cart',['cart'=>$cart, 'cart_item'=>$cart_item]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //untuk memperoleh nilai dari suatu array
    public function result($data){
        foreach ($data as $rt){
            foreach ($rt as $r){
                return $r;
            }
        }
    }

    public function store(Request $request, $id)
    {
        $msg = '';
        $product = Product::find($id);
        //cek ke db apakah user memiliki cart 
        $is_exist = DB::select('
            select coalesce(c.id,-1) as id
            from carts c
            where c.status = 0 and c.user_id = :u_id 
        ',['u_id'=>Auth::id()]);
        $c_id = $this->result($is_exist);
        //jika cart ada maka cari cart item id (berdasarkan cart id user dan produk tertentu)
        if($c_id != -1 && $c_id != null){
            $is_exist = DB::select('
                select coalesce(ci.id,-1) as id
                from cart_items ci
                where ci.cart_id = :c_id and ci.product_id = :p_id
            ',['c_id'=>$c_id, 'p_id'=>$id]);

            $is_exist_cart_item = $this->result($is_exist);
            //jika cart item tidak ada maka dibuat cart item baru utk produk tersebut dan cart diupdate total costnya 
           if ($is_exist_cart_item== null || $is_exist_cart_item== -1){
               $cart_item = new Cart_item();
               $cart_item->cost = $product->price;
               $cart_item->cart_id = $c_id;
               $cart_item->product_id = $id;
               $cart_item->save();

               $update_cart = Cart::find($c_id);
               $update_cart->total_cost = $update_cart->total_cost + $product->price;
               $update_cart->save();
               $msg = 'Success add to cart';

           }
           //jika cart item dengan produk tersebut sudah ada maka tinggal di update kuantitasnya serta total cost di cart sendiri harus diupdate
           else{
               $update_cart_item = Cart_item::find($this->result($is_exist));
               $update_cart_item->qty++;
               $update_cart_item->save();

               $update_cart = Cart::find($c_id);
               $update_cart->total_cost = $update_cart->total_cost + $product->price;
               $update_cart->save();

               $msg = 'Success update cart';
           }
           //jika cart tidak ada maka dibuat baru serta ditambahkan cart item untuk produk yang ingin dibeli
        }else{
            $new_cart = new Cart;
            $new_cart->total_cost = $product->price;
            $new_cart->user_id = Auth::id();
            $new_cart->save();

            $cart_item = new Cart_item();
            $cart_item->cost = $product->price;
            $cart_item->cart_id = $new_cart->id;
            $cart_item->product_id = $id;
            $cart_item->save();
            $msg = 'Success add to cart';
        }
        //kembali ke view dengan pesan sesuai operasi yang dilakukan
        return redirect()->back()->with('message',$msg);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        //mencari cart item sesuai id yang dipassing serta melakukan operasi delete pada cart item produk tertentu
        $cart_item = Cart_item::find($id);
        $cart = Cart::find($cart_item->cart_id);
        $cart->total_cost = $cart->total_cost - ($cart_item->cost*$cart_item->qty);
        $cart->save();
        $cart_item->delete();

        //kembali ke view dengan pesan
        return redirect()->back()->with('message','Success delete item '.$cart_item->product->name);
    }
}

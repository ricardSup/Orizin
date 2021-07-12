<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Category;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Product;
class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

 
    public function index(Request $request)
    {
        //mengambil semua data category utk ditampilkan
        $genres = Category::all();

        //menerima input keyword dan c
        $search_data = $request->input('keyword');
        $cat = $request->input('c');

        //query ke db untuk pencarian berdasarkan category, dan nama dan ditampilkan hasilnya 6 data per halaman
        $products = DB::table('products as p')
            ->join('categories as c', 'c.id', '=' ,'p.category_id')
            ->where('p.name', 'like', '%'.$search_data.'%')
            ->where('c.name', 'like', '%'.$cat.'%')
            ->select('p.*','c.name as cat')
            ->paginate(6);

        $prd = new Product();
        //instansiasi produk untuk memanfaatkan fungsi rate_calc(mendapat rata2 rate per produk) pada model. Serta memberikan setiap nama produk sebagai slug 
        foreach ($products as $product){
            $product->rate = $prd->rate_calc($product->id);
            $product->slug = str_replace(' ', '-', strtolower($product->name));
        }
        //kembali ke home,dengan menyisipkan data products dan genres
        return view('home', compact('products','genres'));
    }
}

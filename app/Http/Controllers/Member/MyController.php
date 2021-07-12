<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;

use App\Http\Requests;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;

use App\Product;
class MyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //mencari semua data games yang telah dibeli oleh user login
        $mygames = DB::table('carts as c')
        ->join('cart_items as ci', 'c.id', '=', 'ci.cart_id')
        ->join('products as p', 'p.id','=','ci.product_id')
        ->where('c.user_id', '=', Auth::id())
        ->where('c.status', '=', 1)
        ->select('p.name','p.picture','p.id')->paginate(6);

        $prd = new Product();
        //menambahkan atribut rata-rata rate pada produk-produk yang telah dibeli
        foreach ($mygames as $product)
        {
            $product->rate = $prd->rate_calc($product->id);
        }
        //kembali ke view dengan passing data-data game
        return view('Member.mygame', compact('mygames'));
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
    public function store(Request $request)
    {
        //
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
        //
    }
}

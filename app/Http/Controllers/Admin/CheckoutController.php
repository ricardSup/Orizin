<?php

namespace App\Http\Controllers\Admin;

use App\Payment;
use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Controllers\Controller;

use Carbon\Carbon;

use App\Cart;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //apabila checkout dilakukan maka transaksi dibuat
        $new_payment = new Payment();
        //menginisiasi tanggal pembayaran sesuai waktu checkout
        $new_payment->date = Carbon::now();
        $new_payment->total_cost = $request['total_c'];
        $new_payment->cart_id = $request['cart_id'];
        $new_payment->save();
        //status cart yang telah masuk checkout akan diubah menjadi 1, menandakan bahwa cart tersebut telah dibayar
        $cart = Cart::find($request['cart_id']);
        $cart->status = 1;
        $cart->save();
        //kembali ke view cart dengan pesan
        return redirect('/cart')->with('message','Checkout success');
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

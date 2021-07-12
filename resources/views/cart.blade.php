@extends('layouts.app')
@section('content')
    <div class="container">
    <!-- jika ada pesan maka ditampilkan -->
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Your Order Details</h3>
                    </div>
                    <div class="panel-body">
                    <!-- jika cart ada maka looping through cart item -->
                    @if(!is_null($cart))
                        @foreach($cart_item as $product)
                            <div class="row">
                                <div class="col-md-4">
                                    <img class="img-responsive center-block img-product" src="{{url('/images/'.$product->picture)}}" alt="{{$product->p_c_name}}">
                                </div>
                                <div class="col-md-6 col-md-offset-1">
                                    <div class="row">
                                        <span class="pull-left"><a href="{{ URL('/product').'/'.$product->slug}}"><h3>{{$product->name}}</h3></a></span>
                                        <span class="pull-right" ><h3>Rp. {{$product->p_harga}} (x{{$product->p_qty}})</h3></span>
                                    </div>
                                    <div class="row">
                                        <span class="pull-left"><p>{{$product->p_desc}}</p></span>
                                        <span class="pull-right"><a href="{{URL('/cart/delete').'/'.$product->ci_id}}"><span class="glyphicon glyphicon-trash"></span></a></span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Order Summary</h3>
                    </div>
                    <!-- total harga, total qty dari cart sekarang -->
                    <div class="panel-body">
                        <div class="col-md-10 col-md-offset-1">
                            <div class="row"><span class="pull-left"><p>@if(!is_null($cart)){{$cart->total_qty}} @else 0 @endif item in your cart</p></span> <span class="pull-right">Rp. @if(!is_null($cart)){{$cart->total_cost}}@else 0 @endif</span></div>
                            <div class="row"><span class="pull-left"><p>Total</p></span> <span class="pull-right">Rp. @if(!is_null($cart)){{$cart->total_cost}} @else 0 @endif</span></div>
                            <form action="{{URL('/checkout')}}" method="post">
                                @if(!is_null($cart))<input type="hidden" name="cart_id" value="{{$cart->id}}">@endif
                                @if(!is_null($cart))<input type="hidden" name="total_c" value="{{$cart->total_cost}}">@endif
                                {{ csrf_field() }}
                                <div class="text-center">
                                    <button class="btn btn-warning btn-lg btn-block" @if(is_null($cart)) disabled="disabled" @endif>Checkout</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
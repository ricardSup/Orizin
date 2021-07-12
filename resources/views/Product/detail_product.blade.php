@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
        <!-- apabila ada pesan maka ditampilkan -->
            @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif
            <div class="col-md-8 bg-success">
                <div class="col-md-4">
                    <img class="img-responsive img-product" src="{{url('/images/'.$product->picture)}}" alt="{{$product->category->name}}">
                </div>
                <div class="col-md-8">

                    <div class="row">
                        <span class="pull-left"><a href="{{ URL('/product').'/'.$product->slug}}"><h1>{{$product->name}}</h1></a></span>
                        <span class="pull-right" style="color:red"><h2>Rp. {{$product->price}}</h2></span>
                    </div>
                    <span>
                        <h4>
                        <!-- untuk membuat rate avg yang telah dipassing dari controller -->
                        @for($i=0;$i<$product->rate;$i++)
                            <span class="glyphicon glyphicon-star"></span>
                        @endfor
                        @if($product->rate < 5)
                            @for($j=0; $j<5-$product->rate; $j++)
                                <span class="glyphicon glyphicon-star-empty"></span>
                            @endfor
                        @endif
                        </h4>
                        <h4>GENRE : {{$product->category->name}}</h4>
                        <h4>{{$product->desc}}</h4>
                        <div class="row">
                        <!-- form untuk melakukan rating terhadap produk yang sedang dibuka -->
                            <form action="{{URL('/product/rate').'/'.$product->id}}" method="post">
                                {{ csrf_field() }}
                                <div class="form-group form-group-lg col-xs-4 pull-left">
                                  <label for="rate">Rate this game : </label>
                                  <select class="form-control" id="rate" name="rate_product">
                                    <option>0</option>
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                  </select>
                                    <button type="submit" class="btn btn-default btn-lg">Rate</button>
                                </div>
                            </form>
                            <div class="caption pull-right">
                            <!-- form untuk menambahkan produk tersebut ke dalam cart, apabila telah ada di cart maka di tambah qtynya -->
                                <form action="{{URL('cart/add').'/'.$product->id}}" method="post">
                                    {{ csrf_field() }}
                                    <h4>Add to cart :</h4>
                                    <h3><button class="icon-button"><span class="glyphicon glyphicon-shopping-cart"></span></button></h3>
                                </form>
                            </div>
                        </div>
                    </span>

                </div>
            </div>
        </div>
    </div>
@endsection
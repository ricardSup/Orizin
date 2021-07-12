@extends('layouts.app')

@section('content')
    <div class="container">
    <!-- jika ada pesan maka ditampilkan -->
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        <!-- link untuk menuju ke halaman add produk -->
        <a href="{{URL('product/add')}}"><span class="glyphicon glyphicon-plus"></span>Add New Game</a>
        <table class="table">
            <tr>
                <thead>
                    <td>#</td>
                    <td>Game Name</td>
                    <td>Genre</td>
                    <td>Price</td>
                    <td>Release Date</td>
                    <td>Description</td>
                    <td>Picture</td>
                    <td colspan="2">Action</td>
                </thead>
                <tbody>
                <!-- looping semua produk yang ada -->
                @foreach($products as $product)
                <tr>
                    <td>{{$product->id}}</td>
                    <td>{{$product->name}}</td>
                    <td>{{$product->category->name}}</td>
                    <td>{{$product->price}}</td>
                    <td>{{$product->release_date}}</td>
                    <td>{{$product->desc}}</td>
                    <td>{{$product->picture}}</td>
                    <td>
                    <!-- link untuk delete produk terkait -->
                        <a href="{{ url('product/delete').'/'.$product->id }}"><span class="glyphicon glyphicon-trash"></span></a>
                    </td>
                    <td>
                    <!-- link untuk edit produk terkait -->
                        <a href="{{ url('product/edit').'/'.$product->id }}"><span class="glyphicon glyphicon-edit"></span></a>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </tr>

        </table>
    </div>
@endsection
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
        <h1>Browse</h1>
        <hr>
    </div>

    <div class="row">

        <div class="col-lg-3">
        <!-- kolom filter produk berdasarkan genre -->
            <h1 class="">FILTER</h1>
            <div class="list-group">
                @foreach($genres as $genre)
                    <a class="list-group-item" href="{{route('product.paginate',['c' => $genre->name])}}">{{$genre->name}}</a>
                @endforeach
            </div>
            <!-- kolom pencarian produk -->
            <form action="{{ url()->current() }}">
                <div class="col-md-8">
                    <input type="text" name="keyword" class="form-control" placeholder="Search name" value="{{ request('keyword') }}">
                </div>
                <div class="col-md-4 text-right">
                    <button type="submit" class="btn btn-primary">
                        Search
                    </button>
                </div>
            </form>
        </div>

        <div class="col-lg-9">
            <!-- membagi data yang di passing per row hanya menampilkan 3 data -->
            @foreach($products->chunk(3) as $items)
                <div class="row">
                <!-- menampilkan produk game -->
                    @foreach($items as $product)
                    <div class="col-lg-4">
                        <div class="thumbnail">
                            <img class="img-responsive" src="{{url('/images/'.$product->picture)}}" style="max-width: 180px; height: 250px" alt="{{$product->cat}}">
                            <div class="caption">
                                <a href="{{ URL('/product').'/'.$product->slug}}"><h4><span class="label label-success">{{$product->name}}</span></h4></a>
                                <h4><span>
                                    @for($i=0;$i<$product->rate;$i++)
                                        <span class="glyphicon glyphicon-star"></span>
                                    @endfor
                                    @if($product->rate < 5)
                                        @for($j=0; $j<5-$product->rate; $j++)
                                            <span class="glyphicon glyphicon-star-empty"></span>
                                        @endfor
                                    @endif
                                </span></h4>
                                <h3><span style="color:red">Rp. {{$product->price}}</span></h3>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @endforeach
            <div class="row">
            <!-- apabila user melakukan pencarian berdasarkan categori /nama, maka pencarian request tsb akan di tambahkan pada paginasi yang ada-->
                {{ $products->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

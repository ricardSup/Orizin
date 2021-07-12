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
            <div class="col-lg-12">
            <!-- membagi data yang di passing per row hanya menampilkan 3 data -->
                @foreach($mygames->chunk(3) as $items)
                    <div class="row">
                    <!-- menampilkan produk game -->
                        @foreach($items as $product)
                            <div class="col-lg-4">
                                <div class="thumbnail">
                                    <img class="img-responsive" src="{{url('/images/'.$product->picture)}}" style="max-width: 180px; height: 250px" alt="none">
                                    <div class="caption">
                                        <h4><span class="label label-success">{{$product->name}}</span></h4>
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
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!-- apabila user melakukan pencarian berdasarkan categori /nama, maka pencarian request tsb akan di tambahkan pada paginasi yang ada-->
                @endforeach
                {{ $mygames->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
@endsection

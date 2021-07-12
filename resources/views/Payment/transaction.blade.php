@extends('layouts.app')

@section('content')
    <div class="container">
    <!-- jika ada pesan maka ditampilkan -->
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        <table class="table">
            <tr>
                <thead>
                <td>#</td>
                <td>User Name</td>
                <td>Transaction Date</td>
                <td>Action</td>
                </thead>
                <tbody>
                <!-- looping semua data transaksi yang ada -->
                @foreach($payments as $payment)
                    <tr>
                        <td>{{$payment->id}}</td>
                        <td>{{$payment->cart->user->name}}</td>
                        <td>{{$payment->date}}</td>

                        <td>
                        <!-- untuk melakukan penghapusan transaksi terkait -->
                            <a href="{{ url('transaction/delete').'/'.$payment->id }}"><span class="glyphicon glyphicon-trash"></span></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </tr>

        </table>
    </div>
@endsection
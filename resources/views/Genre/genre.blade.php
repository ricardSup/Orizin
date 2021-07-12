@extends('layouts.app')

@section('content')
    <div class="container">
    <!-- jika ada pesan maka ditampilkan -->
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        <!-- untuk link ke halaman add genre -->
        <a href="{{URL('genre/add')}}"><span class="glyphicon glyphicon-plus"></span>Add New Genre</a>
        <table class="table">
            <tr>
                <thead>
                <td>#</td>
                <td>Genre Name</td>
                <td colspan="2" align="center">Action</td>
                </thead>
                <tbody>
                <!-- looping semua data genre yang dipassing dari controller -->
                @foreach($genres as $genre)
                    <tr>
                        <td>{{$genre->id}}</td>
                        <td>{{$genre->name}}</td>
                        <td align="center">
                        <!-- link utk delete data genre terkait -->
                            <a href="{{ url('genre/delete').'/'.$genre->id }}"><span class="glyphicon glyphicon-trash"></span></a>
                        </td>
                        <td align="center">
                        <!-- link utk ke halaman edit genre -->
                            <a href="{{ url('genre/edit').'/'.$genre->id }}"><span class="glyphicon glyphicon-edit"></span></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </tr>

        </table>
    </div>
@endsection
@extends('layouts.app')

@section('content')
    <div class="container">
    <!-- jika ada pesan maka ditampilkan -->
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        <!-- link untuk ke halaman tambah user -->
        <a href="{{URL('user/add')}}"><span class="glyphicon glyphicon-plus"></span>Add New User</a>
        <table class="table">
            <tr>
                <thead>
                <td>#</td>
                <td>Name</td>
                <td>Email</td>
                <td>Date of Birth</td>
                <td>Picture</td>
                <td colspan="2">Action</td>
                </thead>
                <tbody>
                <!-- ditampilkan semua user yang ada di orizin -->
                @foreach($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->DOB}}</td>
                        <td>{{$user->picture}}</td>
                        <td>
                        <!-- link untuk menghapus data user terkait -->
                            <a href="{{ url('user/delete').'/'.$user->id }}"><span class="glyphicon glyphicon-trash"></span></a>
                        </td>
                        <td>
                        <!-- link untuk pindah ke halaman edit user terkait-->
                            <a href="{{ url('user/edit').'/'.$user->id }}"><span class="glyphicon glyphicon-edit"></span></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </tr>

        </table>
    </div>
@endsection
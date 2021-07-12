@extends('layouts.app')

@section('content')
    <div class="container">
    <!-- jika ada error -->
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                <!-- maka ditampilkan semua error yang ada -->
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
            <!-- form untuk membuat user baru -->
                <form method="post" action="{{URL::to('user/add')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="control-label " for="name">
                            Name:
                        </label>
                        <input class="form-control" value="{{ old('name') }}" id="name" name="name" placeholder="Type here..." type="text"/>
                    </div>
                    <div class="form-group ">
                        <label class="control-label " for="email">
                            Email:
                        </label>
                        <input class="form-control" value="{{ old('email') }}" id="email" name="email" placeholder="Type here..." type="text"/>
                    </div>
                    <div class="form-group ">
                        <label class="control-label " for="pwd">
                            Password:
                        </label>
                        <input class="form-control" value="{{ old('pwd') }}" id="pwd" name="pwd" placeholder="Password" type="password"/>
                    </div>
                    <div class="form-group ">
                        <label class="control-label " for="c-pwd">
                            Password Confirmation:
                        </label>
                        <input class="form-control" value="{{ old('c-pwd') }}" id="c-pwd" name="c-pwd" placeholder="Confirmation" type="password"/>
                    </div>
                    <div class="form-group ">
                        <label class="control-label " for="dob">
                            Date of Birth:
                        </label>
                        <input class="form-control" value="{{ old('dob') }}" id="dob" name="dob" type="date"/>
                    </div>
                    <div class="form-group ">
                        <label class="control-label " for="picture">
                            Picture:
                        </label>
                        <input name="file" type="file" id="file">
                    </div>
                    <div class="form-group">
                        <div>
                            <button class="btn btn-primary " name="submit" type="submit">
                                Submit
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

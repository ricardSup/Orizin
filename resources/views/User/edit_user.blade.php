@extends('layouts.app')

@section('content')
    <div class="container">
    <!-- jika ada error maka -->
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                <!-- ditampilkan seluruh error yang ada -->
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
            <!-- form untuk update data user yang terkait -->
                <form method="post" action="{{URL::to('user/edit').'/'.$user->id}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="put">
                    <div class="form-group">
                        <label class="control-label " for="name">
                            Name:
                        </label>
                        <input class="form-control" @if((old('name')) )value ="{{old('name')}}" @else value="{{ $user->name }}" @endif id="name" name="name" placeholder="Type here..." type="text"/>
                    </div>
                    <div class="form-group ">
                        <label class="control-label " for="email">
                            Email:
                        </label>
                        <input class="form-control" readonly  @if((old('email')) )value ="{{old('email')}}" @else value="{{ $user->email }}" @endif id="email" name="email" placeholder="Type here..." type="text"/>
                    </div>
                    <div class="form-group ">
                        <label class="control-label " for="pwd">
                            Password:
                        </label>
                        <input class="form-control" @if((old('pwd')) )value ="{{old('pwd')}}" @endif id="pwd" name="pwd" placeholder="Password" type="password"/>
                    </div>
                    <div class="form-group ">
                        <label class="control-label " for="c-pwd">
                            Password Confirmation:
                        </label>
                        <input class="form-control" @if((old('c-pwd')) )value ="{{old('c-pwd')}}" @endif id="c-pwd" name="c-pwd" placeholder="Confirmation" type="password"/>
                    </div>
                    <div class="form-group ">
                        <label class="control-label " for="dob">
                            Date of Birth:
                        </label>
                        <input class="form-control" @if((old('dob')) )value ="{{old('dob')}}" @else value="{{ $user->DOB }}" @endif id="dob" name="dob" type="date"/>
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

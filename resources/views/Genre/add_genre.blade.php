@extends('layouts.app')

@section('content')
    <div class="container">
    <!-- jika ada error maka -->
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                <!-- looping through error -->
                    @foreach ($errors->all() as $error)
                    <!-- show each error -->
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
            <!-- form utk add genre -->
                <form method="post" action="{{URL::to('genre/add')}}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="control-label " for="name">
                            Genre Name:
                        </label>
                        <input class="form-control" value="{{ old('name') }}" id="name" name="name" placeholder="Type genre" type="text"/>
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

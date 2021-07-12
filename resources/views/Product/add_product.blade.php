@extends('layouts.app')

@section('content')
    <div class="container">
    <!-- apabila ada error maka -->
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                <!-- error tersebut akan ditampilkan satu per satu -->
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
            <!-- form yang mengarah pada penambahan data produk -->
                <form method="post" action="{{URL::to('product/add')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="control-label " for="name">
                            Game Name:
                        </label>
                        <input class="form-control" value="{{ old('name') }}" id="name" name="name" placeholder="Type here..." type="text"/>
                    </div>
                    <div class="form-group ">
                        <label class="control-label " for="price">
                            Price:
                        </label>
                        <input class="form-control" value="{{ old('price') }}" id="price" name="price" placeholder="Type here..." type="text"/>
                    </div>
                    <div class="form-group ">
                        <label class="control-label " for="release_date">
                            Release Date:
                        </label>
                        <input class="form-control" value="{{ old('release_date') }}" id="release_date" name="release_date" placeholder="mm/dd/yyyy" type="date"/>
                    </div>
                    <div class="form-group ">
                        <label class="control-label " for="desc">
                            Description:
                        </label>
                        <textarea class="form-control" rows="5" id="desc" name="desc"></textarea>
                    </div>
                    <div class="form-group ">
                        <label class="control-label " for="genre">
                            Genre:
                        </label>
                        <select name="genre" class="form-control" id="genre">
                            @foreach($genres as $key => $name)
                                <option value="{{ $key }}"  @if (old('genre') == $key) selected="selected" @endif> {{ $name }} </option>
                            @endforeach
                        </select>
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

@extends('layouts.app')

@section('content')
    <div class="container">
    <!-- jika ada error maka -->
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                <!-- ditampilkan semua error yang ada -->
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
            <!-- form utk update data produk -->
                <form method="post" action="{{URL::to('product/edit/'.$product->id)}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="put">
                    <div class="form-group">
                        <label class="control-label " for="name">
                            Game Name:
                        </label>
                        <input class="form-control" @if((old('name')) )value ="{{old('name')}}" @else value="{{ $product->name }}" @endif id="name" name="name" placeholder="Type here..." type="text"/>
                    </div>
                    <div class="form-group ">
                        <label class="control-label " for="price">
                            Price:
                        </label>
                        <input class="form-control" @if((old('price')) )value ="{{old('price')}}" @else value="{{ $product->price }}" @endif id="price" name="price" placeholder="Type here..." type="text"/>
                    </div>
                    <div class="form-group ">
                        <label class="control-label " for="release_date">
                            Release Date:
                        </label>
                        <input class="form-control" @if((old('release_date')) )value ="{{old('release_date')}}" @else value="{{ $product->release_date }}" @endif id="release_date" name="release_date" placeholder="mm/dd/yyyy" type="date"/>
                    </div>
                    <div class="form-group ">
                        <label class="control-label " for="desc">
                            Description:
                        </label>
                        <textarea class="form-control" rows="5" id="desc" name="desc">@if(old('desc')){{ old('desc') }}@elseif($product->desc){{{$product->desc}}}@endif</textarea>
                    </div>
                    <div class="form-group ">
                        <label class="control-label " for="genre">
                            Genre:
                        </label>
                        <select name="genre" class="form-control" id="genre">
                            @foreach($genres as $key => $name)
                                <option value="{{ $key }}" {{ ($name == $product->category->name)?'selected':'' }} {{ ($key == old('genre'))?'selected':'' }}> {{ $name }} </option>
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
                                Update
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

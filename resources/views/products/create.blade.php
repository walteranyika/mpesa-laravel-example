@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Add Product</div>

                    <div class="card-body">
                        <form action="/products" method="post">

                            @csrf

                            <div class="form-group">
                                <label>Product Names</label>
                                <input type="text" class="form-control" value="{{old('name')}}" name="name">
                                @if($errors->has('name'))
                                    <span class="text-danger">{{$errors->first('name')}}</span>
                                @endif
                            </div>


                            <div class="form-group">
                                <label>Product's Quantity</label>
                                <input type="text" class="form-control" value="{{old('quantity')}}" name="quantity">
                                @if($errors->has('quantity'))
                                    <span class="text-danger">{{$errors->first('quantity')}}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>Product's Price</label>
                                <input type="text" class="form-control" value="{{old('price')}}" name="price">
                                @if($errors->has('price'))
                                    <span class="text-danger">{{$errors->first('price')}}</span>
                                @endif
                            </div>

                            <button class="btn btn-info">Add Product</button>


                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


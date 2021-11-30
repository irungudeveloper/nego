@extends('adminlte::page')

@section('title', 'NEGO | E-com')

@section('content_header')
    <h1 class="m-0 text-dark">Products</h1>
    <p><a href="#">Dashboard</a>/<a href="#">Product</a></p>
@stop

@section('content')
    
    <div class="row">
        <div class="col-12 col-sm-12 col-lg-12 col-xs-12">
          <div class="card">
              <div class="card-body">
                  <form method="POST" action="{{route('product.store')}}" enctype="multipart/form-data">
                      @csrf
                    <label for="product_name">Product Name</label>
                    <input id="brand_name" type="text" name="product_name" placeholder="Product Name" class="form-control mb-2">
                    <label>Product Quantity</label>
                    <input type="number" name="product_quantity" class="form-control">
                    <div class="form-group row p-2">
                        <div class="col-12 col-md-6 col-lg-6">
                            <label>Product Retail Price</label>
                            <input type="number" name="product_retail_price" class="form-control">
                        </div>
                        <div class="col-12 col-md-6 col-lg-6 ">
                            <label>Product Final Price</label>
                            <input type="number" name="product_final_price" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row p-2">
                        <div class="col-12 col-md-6 col-lg-6">
                            <label>Category</label>
                            <select class="form-control" name="category_id">
                                <option>Select Category</option>
                                @foreach($category as $data)
                                    <option value=" {{$data->id }} "> {{ $data->category_name}} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6">
                            <label>Brand</label>
                            <select class="form-control" name="brand_id">
                                <option>Select Brand</option>
                                @foreach($brand as $data)
                                <option value="{{$data->id}}">{{$data->brand_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <label>Product Image</label>
                    <input type="file" name="product_image" class="form-control">
                    <div class="form-group row pt-3 p-2">
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="negotiable" id="negotiable" value="1">
                              <label class="form-check-label" for="negotiable">
                                Negotiable 
                              </label>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="availability_status" id="availability" value="1">
                              <label class="form-check-label" for="availability">
                                Available
                              </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row p-2">
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="negotiable" id="n_negotiable" value="0">
                              <label class="form-check-label" for="n_negotiable">
                                Not Negotiable 
                              </label>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="availability_status" id="n_availability" value="0">
                              <label class="form-check-label" for="n_availability">
                                Not Available
                              </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 text-center p-3">
                        <input type="submit" name="submit" class=" btn btn-solid btn-primary" value="Create Product">
                    </div>
                  </form>
              </div>
          </div>
        </div>       
    </div>
@stop

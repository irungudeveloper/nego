@extends('adminlte::page')

@section('title', 'NEGO | E-com')

@section('content_header')
    <h1 class="m-0 text-dark">Discount</h1>
    <p><a href="#">Dashboard</a>/<a href="#">Discount</a></p>
@stop

@section('content')
    
    <div class="row">
        <div class="col-12 col-sm-12 col-lg-12 col-xs-12">
          <div class="card">
              <div class="card-body">
                  <form method="POST" action="{{route('discount.store')}}">
                      @csrf

                      <div class="form-group row">
                          <label for="product">Product</label>
                          <select class="form-control" name="product_id">
                              <option>SELECT PRODUCT</option>

                              @forelse($product as $data)
                                <option value=" {{ $data->id }} "> {{ $data->product_name }} </option>
                              @empty
                                <option>No Products Available Yet <a class="btn btn-solid btn-success" href=" {{ route('product.create') }} "> Create Product </a> </option>
                              @endforelse
                          </select>
                      </div>

                     <div class="form-group row">
                         <label for="percentage">Percentage Discount</label>
                         <input type="number" name="percentage" class="form-control">
                     </div>


                    <div class="col-12 text-center p-3">
                        <input type="submit" name="submit" class=" btn btn-solid btn-success" value="Generate Discount Code">
                    </div>
                  </form>
              </div>
          </div>
        </div>       
    </div>
@stop

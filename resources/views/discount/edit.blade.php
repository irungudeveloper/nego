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
                @foreach($discount as $discount)
                  <form method="POST" action="{{route('discount.update',$discount->id)}}">
                      @csrf
                      @method('PUT')
                    <div class="form-group row">
                      <label for="discount">Discount Code</label>
                      <input type="text" name="discount" class="form-control" placeholder="{{ $discount->code }} " readonly>
                    </div>

                      <div class="form-group row">
                          <label for="product">Product</label>
                          <select class="form-control" name="product_id">

                      
                          <option value=" {{ $discount->product_id }} " > {{ $discount->product->product_name }} </option>
                                
                
                          <option>------------------------------------------------------------------------------------------</option>
                              @forelse($product as $data)
                                <option value=" {{ $data->id }} "> {{ $data->product_name }} </option>
                              @empty
                                <option>No Products Available Yet <a class="btn btn-solid btn-success" href=" {{ route('product.create') }} "> Create Product </a> </option>
                              @endforelse
                          </select>
                      </div>

                      <div class="form-group row">
                        <label for="percentage">Discount Percentage</label>
                        <input type="number" value="{{$discount->percentage}}" name="percentage" class="form-control" >

                      </div>

                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="active" id="exampleRadios1" value="0" checked>
                        <label class="form-check-label" for="exampleRadios1">
                          Disable Discount Code
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="active" id="exampleRadios2" value="1">
                        <label class="form-check-label" for="exampleRadios2">
                          Activate Discount Code
                        </label>
                      </div>
                      @endforeach

                    <div class="col-12 text-center p-3">
                        <input type="submit" name="submit" class=" btn btn-solid btn-success" value="Update Discount Code">
                    </div>
                  </form>
              </div>
          </div>
        </div>       
    </div>
@stop

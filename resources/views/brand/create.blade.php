@extends('adminlte::page')

@section('title', 'NEGO | E-com')

@section('content_header')
    <h1 class="m-0 text-dark">Brand</h1>
    <p><a href="#">Dashboard</a>/<a href="#">Brand</a></p>
@stop

@section('content')
    
    <div class="row">
        <div class="col-12 col-sm-12 col-lg-12 col-xs-12">
          <div class="card">
              <div class="card-body">
                  <form method="POST" action="{{route('brand.store')}}">
                      @csrf
                    <label for="brand_name">Brand Name</label>
                    <input id="brand_name" type="text" name="brand_name" placeholder="Brand Name" class="form-control">
                    <div class="col-12 text-center p-3">
                        <input type="submit" name="submit" class=" btn btn-solid btn-primary" value="Create Brand">
                    </div>
                  </form>
              </div>
          </div>
        </div>       
    </div>
@stop

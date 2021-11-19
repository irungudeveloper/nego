@extends('adminlte::page')

@section('title', 'NEGO | E-com')

@section('content_header')
    <h1 class="m-0 text-dark">Delivery Zone</h1>
    <p><a href="#">Dashboard</a>/<a href="#">Zone</a></p>
@stop

@section('content')
    
    <div class="row">
        <div class="col-12 col-sm-12 col-lg-12 col-xs-12">
          <div class="card">
              <div class="card-body">
                  <form method="POST" action="{{route('delivery.store')}}">
                      @csrf
                    <label for="area_name">Area Name</label>
                    <input id="area_name" type="text" name="area_name" placeholder="Area Name" class="form-control">

                    <label for="delivery_cost">Delivery Cost</label>
                    <input type="number" name="delivery_cost" id="delivery_cost" class="form-control" >

                    <div class="col-12 text-center p-3">
                        <input type="submit" name="submit" class=" btn btn-solid btn-primary" value="Create Delivery Zone">
                    </div>
                  </form>
              </div>
          </div>
        </div>       
    </div>
@stop

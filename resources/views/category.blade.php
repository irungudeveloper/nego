@extends('adminlte::page')

@section('title', 'NEGO | E-com')

@section('content_header')
    <h1 class="m-0 text-dark">Category</h1>
    <p><a href="#">Dashboard</a>/<a href="#">Category</a></p>
@stop

@section('content')
    <div class="row">
        <div class=" col-md-6 col-6 col-sm-12 col-lg-6 col-xs-6">
            <div class="card">
                <div class="card-body">
                    <p><span>12</span> Existing Categories</p>
                </div>
            </div>
            
        </div>
        <div class="col-md-6 col-6 col-sm-12 col-lg-6 col-xs-6">
            <div class="card">
                <div class="card-body">
                    <p><span>10</span> Products</p>
                </div>
            </div>
            
        </div>
    </div>
    
    <div class="row">
        <div class="col-12 col-sm-12 col-lg-12 col-xs-12">
           @foreach($category as $data)
            {{$data}}
           @endforeach
        </div>       
    </div>
@stop

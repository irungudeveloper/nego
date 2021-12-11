@extends('adminlte::page')

@section('title', 'NEGO | E-com')

@section('content_header')
    <h1 class="m-0 text-dark">Dashboard</h1>
    
@stop

@section('content')

    <div class="row">
        <div class="col-12 col-sm-12 col-md-4">
            <div class="card">
                <div class="card-body bg-primary">
                    <h3 class="h3">{{ $order_items }}</h3>
                    <p>Products Purchased</p>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-12 col-md-4">
            <div class="card">
                <div class="card-body bg-success">
                    <h3 class="h3">Ksh. {{ $order_amount }}</h3>
                    <p>Average Amount Spent</p>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-12 col-md-4">
            <div class="card">
                <div class="card-body bg-info">
                    <h3 class="h3">{{ $cart_item }}</h3>
                    <p>Products In Your Cart</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <p>You Are Logged In!!</p>
                </div>
            </div>
        </div>
    </div>


@stop

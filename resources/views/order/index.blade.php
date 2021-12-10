@extends('adminlte::page')

@section('title', 'NEGO | E-com')

@section('content_header')
    <h1 class="m-0 text-dark">Orders</h1>
    <p><a href="#">Dashboard</a>/<a href="#">Orders</a></p>
@stop

@section('content')
    
    <div class="row">
        <div class="col-12 col-sm-12 col-md-6 col-lg-6 p-2">
            <div class="card">
                <div class="card-body">
                    <h4><span>20</span> Orders Pending</h4>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-12 col-md-6 col-lg-6 p-2">
            <div class="card">
                <div class="card-body">
                    <h4><span>50</span> Total Orders</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-sm-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <table id="order_table" class="table-hover table-borderd table-striped table-responsive" style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Customer Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Delivery Area</th>
                                <th scope="col">Product</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Amount</th>   
                                <th scope="col">Delivery Status</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($order as $data)
                            <tr>
                                <td class="p-3" > {{ $data->id }} </td>
                                
                                @foreach($data->user as $user)
                                    <td class="p-3"> {{ $user->first_name }}, {{ $user->last_name }} </td>
                                    <td class="p-3"> {{ $user->email }} </td>
                                    <td class="p-3"> {{ $user->billing->delivery->area_name }} </td>
                                @endforeach

                                @foreach($data->product as $product)
                                    <td class="p-3">
                                        <img src="{{asset('storage/images/'.$product->product_image)}}" alt="" height="50px" width="50px">
                                        <p> {{ $product->product_name }} </p>
                                    </td>
                                @endforeach
                                <td class="p-3"> {{ $data->quantity }} </td>
                                <td class="p-3"> {{ $data->amount }} </td>
                                <td class="p-3">
                                    @if($data->delivery_status == 0)
                                     <p class="btn btn-solid btn-info">Not Delivered</p>
                                    @elseif($data->delivery_status == 3)
                                     <p class="btn btn-solid btn-danger">Order Cancelled</p>
                                    @else
                                     <p class="btn btn-solid btn-success">Delivered</p>
                                    @endif
                                </td>
                                <td class="p-3">
                                    @if($data->delivery_status == 0)
                                     <a href="{{route('delivery.confirm',$data->id)}}" class="btn btn-solid btn-primary">Confirm Delivery</a></td>
                                    @else
                                    <p class="btn btn-solid btn-secondary">No Action</p>
                                    @endif
                            </tr>
                            @empty
                                <tr>
                                  <td colspan="100%" class="text-center">No Orders Yet</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>


@stop

@section('js')
    <script>
         $('#order_table').DataTable();
     </script>
@stop
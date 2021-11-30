@extends('adminlte::page')

@section('title', 'NEGO | E-com')

@section('content_header')
    <h1 class="m-0 text-dark">Orders</h1>
    <p><a href="#">Dashboard</a>/<a href="#">Order</a></p>
@stop

@section('content')
    
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 p-2">
            <div class="card">
                <div class="card-body">
                    <h4><span>2</span> Orders Pending</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-sm-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <table id="order_table" class="table-hover table-borderd table-striped table-responsive-sm" style="width:100%">
                        <thead>
                            <tr>
                                <th >#</th>
                                <th >Delivery Area</th>
                                <th >Product</th>
                                <th>Quantity</th>
                                <th>Amount</th>   
                                <th>Delivery Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($order as $data)
                            <tr>
                                <td class="p-3" > {{ $data->id }} </td>
                                
                                @foreach($data->user as $user)
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
                                    @else
                                     <p class="btn btn-solid btn-success">Delivered</p>
                                    @endif
                                </td>
                            </tr>
                            @empty
                                <tr>
                                  <td colspan="100%" class="text-center">No Orders Yet <a href="/store" class="btn btn-solid btn-primary">Start Shopping</a> </td>
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
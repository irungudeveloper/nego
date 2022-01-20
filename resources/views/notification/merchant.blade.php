@extends('adminlte::page')

@section('title', 'NEGO | E-com')

@section('content_header')
    <h1 class="m-0 text-dark">Notification</h1>
    <p><a href="#">Dashboard</a>/<a href="#">Notification</a></p>
@stop

@section('content')
    <div class="row">
        <div class=" col-md-12 col-12 col-sm-12 col-lg-12 col-xs-3 ">
            <div class="card bg-info">
                <div class="card-body">
                    <p class="h4">{{ $notification_count }}</p> Number of Negotiations
                </div>
            </div>
            
        </div>
        <div class=" col-md-3 col-12 col-sm-12 col-lg-3 col-xs-3 ">
            <div class="card bg-success">
                <div class="card-body">
                   <p class="h4"> {{ $successful_negotiation }}</p> <p>Succesful Negotiations</p>
                </div>
            </div>
            
        </div>
        <div class=" col-md-3 col-12 col-sm-12 col-lg-3 col-xs-3 ">
            <div class="card bg-dark">
                <div class="card-body">
                    <p class="h4">{{ $cancelled_by_merchant }}</p> <p> Cancelled By Merchant</p>
                </div>
            </div>
            
        </div>
        <div class=" col-md-3 col-12 col-sm-12 col-lg-3 col-xs-3">
            <div class="card  bg-secondary">
                <div class="card-body">
                   <p class="h4"> {{ $cancelled_by_customer }}</p> <p> Cancelled by you</p>
                </div>
            </div>
            
        </div>
        <div class=" col-md-3 col-12 col-sm-12 col-lg-3 col-xs-3 ">
            <div class="card bg-primary">
                <div class="card-body">
                   <p class="h4"> {{ $pending_negotiation }}</p> <p> Pending Negotiations</p>
                </div>
            </div>
            
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-sm-12 col-lg-12 col-xs-12">
           <div class="card">
               <div class="card-body">
                <table id="category_table" class="table table-hover table-responsive">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Customer Name</th>
                      <th scope="col">Customer Email</th>
                      <th scope="col">Product Name</th>
                      <th scope="col">Percentage Discount Negotiated</th>
                      <th scope="col">Negotiation Status</th>
                      <th scope="col">Actions</th>
                    </tr>
                  </thead>
                  <tbody>

                    @forelse($notification as $data)
                        <tr>
                            <td> {{ $data->id }} </td>
                            <td> {{ $data->customer->first_name }}, {{ $data->customer->last_name }} </td>
                            <td> {{ $data->customer->email }} </td>
                            <td> {{ $data->product->product_name }} </td>
                            <td> {{ $data->discount_amount }} </td>
                            
                            @if($data->negotiation_status == 0)
                            <td> <p class="badge badge-info">Pending Negotiation</p>  </td>
                            @elseif($data->negotiation_status == 1)
                            <td> <p class="badge badge-success">Succesful Negotiation </p> </td>
                            @elseif($data->negotiation_status == 2)
                            <td> <p class="badge badge-secondary">Cancelled by You</p> </td>
                            @else
                            <td> <p class="badge badge-dark">Cancelled by Customer</p> </td>  
                            @endif

                            @if($data->negotiation_status == 0)
                            <td>
                                <div class="row">
                                    <div class="col-6">
                                         <a href=" {{ route('notification.update',['id'=>$data->id,'status'=>1]) }} " class="btn btn-solid btn-primary">Succesful Negotiation</a>  
                                    </div>
                                    <div class="col-6">
                                         <a href=" {{ route('notification.update',['id'=>$data->id,'status'=>2]) }} " class="btn btn-solid btn-danger">Cancel Negotiation</a>
                                    </div>
                                </div>
                               
                            </td>
                            @else
                            <td><p class="badge badge-secondary">No action available</p></td>
                            @endif

                        </tr>
                    @empty

                    @endforelse
                    
                  </tbody>
            </table>
               </div>
           </div>
            
        </div>       
    </div>
    
  

<!-- Modal -->
@stop

@section('js')
    <script>
         $('#category_table').DataTable();
     </script>
@stop
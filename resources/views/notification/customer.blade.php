@extends('adminlte::page')

@section('title', 'NEGO | E-com')

@section('content_header')
    <h1 class="m-0 text-dark">Notification</h1>
    <p><a href="#">Dashboard</a>/<a href="#">Notification</a></p>
@stop

@section('content')
    <div class="row">
        <div class=" col-md-3 col-12 col-sm-12 col-lg-3 col-xs-3">
            <div class="card">
                <div class="card-body">
                    {{ $notification_count }}
                </div>
            </div>
            
        </div>
        <div class=" col-md-3 col-12 col-sm-12 col-lg-3 col-xs-3">
            <div class="card">
                <div class="card-body">
                    {{ $successful_negotiation }}
                </div>
            </div>
            
        </div>
        <div class=" col-md-3 col-12 col-sm-12 col-lg-3 col-xs-3">
            <div class="card">
                <div class="card-body">
                    {{ $cancelled_by_merchant }}
                </div>
            </div>
            
        </div>
        <div class=" col-md-3 col-12 col-sm-12 col-lg-3 col-xs-3">
            <div class="card">
                <div class="card-body">
                    {{ $cancelled_by_customer }}
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
                      <th scope="col">Merchant Name</th>
                      <th scope="col">Merchant Email</th>
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
                            <td> {{ $data->merchant->first_name }}, {{ $data->customer->last_name }} </td>
                            <td> {{ $data->merchant->email }} </td>
                            <td> {{ $data->product->product_name }} </td>
                            <td> {{ $data->discount_amount }} </td>
                            
                            @if($data->negotiation_status == 0)
                            <td> <p class="badge badge-info">Pending Negotiation</p>  </td>
                            @elseif($data->negotiation_status == 1)
                            <td> <p class="badge badge-success">Succesful Negotiation </p> </td>
                            @elseif($data->negotiation_status == 3)
                            <td> <p class="badge badge-secondary">Cancelled by You</p> </td>
                            @else
                            <td> <p class="badge badge-dark">Cancelled by Merchant</p> </td>  
                            @endif

                            @if($data->negotiation_status == 0)
                            <td>
                                <div class="row">
                                    <div class="col-12">
                                         <a href=" {{ route('notification.update',['id'=>$data->id,'status'=>3]) }} " class="btn btn-solid btn-danger">Cancel Negotiation</a>
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
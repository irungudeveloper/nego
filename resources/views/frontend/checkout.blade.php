@extends('frontend.main')

@section('navbar')
    @include('frontend.navbar')
@stop

@section('content')

<section class="featured spad">
        <div class="container">
        <div class="row">
            <div class="col-12 p-2">
                <h4 class="text-center">Order Confirmation</h4>
            </div>
            <div class="col-12 col-sm-12 col-lg-6 col-md-6">
                <!-- <form method="POST" action=" {{ route('bill.store') }} ">
                    @csrf
                    
                    <div class="form-group row">
                        <div class="col-12">
                             @foreach($customer as $data)
                                <input type="hidden" name="first_name" value=" {{ $data->first_name }} ">
                                <input type="hidden" name="last_name" value=" {{ $data->last_name }} ">
                                <input type="hidden" name="email" value=" {{ $data->email }} " >
                                <input type="hidden" name="phone_number" value=" {{ $data->phone_number }} " >
                                @endforeach
                        </div>
                    </div>

                    @foreach($billing as $data)
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                        <select id="delivery" name="delivery_id" placeholder="Select the delivery zone near you">
                                <option value=" {{ $data->delivery->id }} "> {{ $data->delivery->area_name }} </option>
                                <option>--------------------------------------------------------------</option>
                                @foreach($delivery as $del)
                                <option value=" {{ $del->id }} " > {{ $del->area_name }} </option>
                                @endforeach
                        </select>
                        </div>
                    </div>
                    @endforeach

                </form> -->
                <div class="card">
                    <div class="card-header">
                        <h5>Billing Information</h5>
                    </div>
                    <div class="card-body">
                        <form>
                            @foreach($customer as $data)
                            <div class="form-group row">
                                <div class="col-12 col-md-6 col-lg-6">
                                    <label>First Name</label>
                                    <input type="text" name="first_name" value=" {{ $data->first_name }} " class="form-control">    
                                </div>
                                <div class="col-12 col-md-6 col-lg-6">
                                    <label>Last Name</label>
                                    <input type="text" name="last_name" value=" {{ $data->last_name }} " class="form-control">    
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12 col-md-6 col-lg-6">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control" value=" {{ $data->email }} ">
                                </div>
                                <div class="col-12 col-md-6 col-lg-6">
                                    <label>Phone Number</label>
                                    <input type="text" name="phone_number" class="form-control" value=" {{ $data->phone_number }} ">
                                </div>
                            </div>
                            @endforeach
                            <div class="form-group row">
                                <div class="col-12 col-md-12">
                                    <label>Delivery Area</label><br>
                                    <select class="form-control" name="area">
                                        @forelse($billing as $data)
                                          <option value=" {{ $data->delivery_id }} " > {{ $data->delivery->area_name }} </option>
                                        @empty
                                          <option>SELECT DELIVERY AREA</option>
                                        @endforelse
                                        @forelse($delivery as $data)
                                          <option value=" {{ $data->id }} " > {{ $data->area_name }} </option>
                                        @empty
                                          <option>NO DELIVERY ZONES AVAILABLE AT THE MOMENT</option>
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
            <div class="col-12 col-sm-12 col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-center">Order Summary</h4>
                    </div>
                    <div class="card-body">
                        <table id="cart" class="table table-responsive-sm">
                            <thead>
                                <tr>
                                    <th scope="col">Products</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col" class="pl-2">Sub Total</th>
                                </tr>
                            </thead>
                            <tbody>
                               
                                 @php $total = 0 @endphp
                                @forelse($cart as $data)
                                
                                    @php 
                                        $total += $data->total_cost 
                                    @endphp

                                    @foreach($data->product as $product)
                                <tr data-id=" {{ $data->id }} ">
                                    <td class="shoping__cart__item">
                                        <h5 class="text"> {{ $product->product_name }} </h5>
                                    </td>
                                    @endforeach
                                    <td class="shoping__cart__item">
                                        <h5 class="text-center"> {{ $data->product_quantity }} </h5>
                                    </td>
                                    <td class="shoping__cart__total">
                                       <h5 class="text-center"> ksh. {{ $data->total_cost }} </h5> 
                                    </td>
                                </tr>

                                @empty

                                <tr>
                                    <td colspan="100%" class="text-center">No Items In Your Cart</td>
                                </tr>

                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                         <h5> Total : <span> ksh. {{ $total }} </span> </h5>
                    </div>

                </div>
            </div>
        </div>

        <div class="row pt-3">
            <div class="col-12 col-sm-12 col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="text-center">Mobile Payment</h5>
                    </div>
                    <div class="card-body">
                        <form>

                        <input type="hidden" name="amount" value="2" id="amount">

                        <div class="form-group row">
                            <div class="col-12 col-sm-12 col-md-4">
                                <label>Phone Number</label>
                            </div>
                            <div class="col-12 col-sm-12 col-lg-8 col-md-8">
                                <input type="text" id="phone_number" name="phone_number" class="form-control" value="254">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12 col-sm-12 col-lg-12 col-md-12 text-center">
                                <button id="submit" class="btn btn-solid btn-success">Pay</button>
                            </div>

                            <div id="initiate" class="blink col-12 col-sm-12 col-lg-12 col-xs-12 col-md-12 text-center">
                                <h4>Initiating Payment Request</h4>
                            </div>
                            <div id="process" class="blink col-12 col-sm-12 col-lg-12 col-xs-12 col-md-12 text-center">
                                <h4>Processing Payment</h4>
                            </div>
                            <div id="confirm" class="blink col-12 col-sm-12 col-lg-12 col-xs-12 col-md-12 text-center">
                                <h4>Confirming Payment</h4>
                            </div>
                        </div>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>

        </div>
</section>
    @stop

    @section('footer')
        @include('frontend.footer')
    @stop

    @section('script')

        <script type="text/javascript">
            $(document).ready(function()
            {

                var checkoutID="ws_CO_301120211851187024";

                console.log('ready');

                $('#initiate').hide();
                $('#process').hide();
                $('#confirm').hide();

                document.getElementById("submit").addEventListener('click',function(e)
                {
                    
                    e.preventDefault();

                    console.log('clicked');
                    $('#initiate').show();

                    var phone_number = $('#phone_number').val();
                    var amount = $('#amount').val();

                    console.log(phone_number);
                    console.log(amount);

                    // $.ajax({
                    //     url:"pay/mpesa",
                    //     type:"POST",
                    //     data:{
                    //          "_token": "{{ csrf_token() }}",
                    //          phone_number:phone_number,
                    //          amount:amount,
                    //     },
                    //     success: function(response)
                    //     {
                    //         console.table(response);
                    //         $('#initiate').hide();
                    //         $('#process').show();

                    //         checkoutID = response;
                            
                            // setTimeout(function()
                            // {
                                // $('#process').hide();
                                // $('#confirm').show();
                                // $.ajax(
                                // {

                                //      url:"mpesa/confirm",
                                //      type:"POST",
                                //      data:{
                                //               "_token": "{{ csrf_token() }}",
                                //              checkoutID:checkoutID,
                            
                                //             },
                                //     success: function(response)
                                //     {
                                //         console.table(response);

                                //         if (response == false) 
                                //         {
                                //             $('#failed').show();
                                //         }
                                //         else
                                //         {
                                            $.ajax(
                                            {
                                                url:"order",
                                                type:"POST",
                                                data:{
                                                    "_token":" {{ csrf_token() }} ",
                                                },
                                                success: function(response)
                                                {
                                                    console.log(response);
                                                    window.location.href = "store";
                                                },
                                                error: function(response)
                                                {
                                                    console.table(response);
                                                },
                                            });
                                //         };

                                //         $('#confirm').hide();
                                //     },
                                //     error: function(response) 
                                //     {
                                //       console.table(response);

                                //     },
                                // });

                            // },7000);
                    //     },
                    //     error: function(response)
                    //     {
                    //         console.log(response);
                    //     },
                    // });

                });

            });

        </script>

    @stop
@extends('adminlte::page')

@section('title', 'NEGO | E-com')

@section('content_header')
    <h1 class="m-0 text-dark">Billing Information</h1>
    <p><a href="#">Dashboard</a>/<a href="#">Billing</a></p>
@stop

@section('content')
    
    <div class="row">
        <div class="col-12 col-sm-12 col-lg-12 col-xs-12">
          <div class="card">
            <form method="POST" action=" {{ route('bill.store') }} ">
                        @csrf
              <div class="row p-3">

                    
                  <div class="col-12">
                    
                        
                      <h4 class="text-center pb-3">Contact Information</h4>

                      <div class="form-group row">
                          <div class="col-6">
                              <label for="first_name">First Name</label>
                              <input type="text" name="first_name" id="first_name" class="form-control" value=" {{ auth()->user()->first_name }} ">
                          </div>
                          <div class="col-6">
                              <label for="last_name">Last Name</label>
                              <input type="text" name="last_name" id="last_name" class="form-control" value=" {{ auth()->user()->last_name }} ">
                          </div>
                      </div>
                      <div class="form-group row">
                          <div class="col-6">
                              <label for="phone_number">Phone Number</label>
                              @forelse($customer as $data)
                              <input type="text" name="phone_number" id="phone_number" class="form-control" value=" {{ $data->phone_number }} ">
                              @empty
                               <input type="text" name="phone_number" id="phone_number" class="form-control">
                              @endforelse
                          </div>
                          <div class="col-6">
                              <label for="email">Email</label>
                              <input type="email" name="email" id="email" class="form-control" value=" {{ auth()->user()->email }} ">
                          </div>
                      </div>
                    
                  </div>
                  
                   <div class="col-12 pt-3">
                      <h4 class="text-center pb-3">Address Information</h4>
                        <div class="form-group row">
                            <div class="col-12 p-2">
                                <label for="delivery_zone" >Select Zone Near You</label>
                                <select id="delivery_zone" name="delivery_id" class="form-control">
                                    @forelse($delivery as $data)
                                    <option value=" {{ $data->id }} " > {{ $data->area_name }} </option>
                                    @empty
                                    <option value="0">Main Branch, CBD, nAIROBI</option>
                                    @endforelse
                                </select>
                            </div>
                            <div class="col-12 p-2">
                                <label for="address">Address</label>
                                @forelse($billing as $data)
                                <input type="text" name="address" class="form-control" value=" {{ $data->address }} ">
                                @empty
                                <input type="text" name="address" class="form-control">
                                @endforelse
                            </div>
                        </div>
                  </div>

                   <div class="col-12 pt-3">
                      <h4 class="text-center pb-3">Payment Information</h4>
                      
                      <label for="payment">Choose Suitable Payment Method</label>
                      <select id="payment" class="form-control" name="payment_mode"> 
                          <option value="1">Mobile Money (M-Pesa)</option>
                          <option value="2">Cash On Delivery</option>
                          <option value="3">Card Payment</option>
                      </select>
                  </div>

                  <div class="col-12 text-center p-3">
                      <input type="submit" name="submit" class="btn btn-solid btn-primary" value="Save">
                  </div>

              
              </div>
          </form>
          </div>
        </div>       
    </div>

    <!-- Button trigger modal -->

@stop



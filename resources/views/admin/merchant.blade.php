@extends('adminlte::page')

@section('title', 'NEGO | E-com')

@section('content_header')
    <h1 class="m-0 text-dark">Account Settings</h1>
    <p><a href="#">Dashboard</a>/<a href="#">Account</a></p>
@stop

@section('content')

    <div class="row">

        <div class="col-12 col-sm-12 col-lg-12 col-xs-12">
          <div class="card">
              <div class="card-body">
                <h4 class="text-center pb-3">Account Details</h4>
                  <form method="POST" action="{{route('merchant.store')}}">
                      @csrf
                   
                   <div class="form-group row">
                    <div class="col-6">
                        <label for="first_name">First Name</label>
                        <input type="text" name="first_name" class="form-control" value=" {{ auth()->user()->first_name }} " id="first_name">
                    </div>  
                    <div class="col-6">
                        <label for="last_name">Last Name</label>
                        <input type="text" name="last_name" class="form-control" value=" {{ auth()->user()->last_name }} " id="last_name">
                    </div>    
                   </div>

                   <div class="form-group row">
                       <div class="col-6">
                           <label for="phone_number">Phone Number</label>
                           @if(count($merchant) > 0)
                            @foreach($merchant as $data)
                           <input type="text" name="phone_number" value=" {{ $data->phone_number }} " placeholder="Phone Number" class="form-control">
                            @endforeach
                           @else
                             <input type="text" name="phone_number" placeholder="Phone Number" class="form-control">
                           @endif
                       </div>
                       <div class="col-6">
                           <label for="email">Email</label>
                           <input type="email" name="email" value=" {{ auth()->user()->email }} " class="form-control">
                       </div>
                   </div>
                   <div class="form-group row"> 
                       <div class="col-12">
                           <div class="form-check">
                              <input class="form-check-input" type="radio" name="share_contact" id="exampleRadios1" value="1" checked>
                              <label class="form-check-label" for="exampleRadios1">
                                Share My Contact Information For Negotiation Purposes
                              </label>
                            </div>
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="share_contact" id="exampleRadios2" value="0">
                              <label class="form-check-label" for="exampleRadios2">
                                Do Not Share My Contact Information
                              </label>
                            </div>
                       </div>
                   </div>
                    <div class="col-12 text-center p-3">
                        <input type="submit" name="submit" class=" btn btn-solid btn-primary" value="Update Details">
                    </div>
                  </form>
              </div>
          </div>
        </div>       
    </div>

    <!-- Button trigger modal -->

@stop

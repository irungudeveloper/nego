@extends('frontend.main')

@section('navbar')
	@include('frontend.navbar')
@stop

@section('content')

	<section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <table id="cart" class="table-responsive">
                            <thead>
                                <tr>
                                    <th class="shoping__product">Products</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <form method="POST" action=" {{ route('update.cart') }} ">
                                	@csrf

                            	 @php $total = 0 @endphp
                            	@forelse($cart as $data)
                            	
                            		@php 
                            			$total += $data->total_cost 
                            		@endphp

                            		<input type="hidden" name="id[]" value=" {{ $data->id }} ">


                            		@foreach($data->product as $product)

                            		<input type="hidden" name="cost[]" value=" {{ $product->product_retail_price }} ">


                            	<tr data-id=" {{ $data->id }} ">
                                    <td class="shoping__cart__item">
                                        <img src="{{asset('storage/images/'.$product->product_image)}}" alt="" height="150px" width="150px">
                                        <h5> {{ $product->product_name }} </h5>
                                    </td>
                                    <td class="shoping__cart__price">
                                       ksh. {{ $product->product_retail_price }}
                                    </td>
                                    @endforeach
                                    <td class="shoping__cart__quantity">
                                        <div class="quantity">
                                            <div class="pro-qty">
                                                <input type="text" placeholder="{{ $data->product_quantity }} " value=" {{ $data->product_quantity }} " name="product_quantity[]">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="shoping__cart__total">
                                       ksh. {{ $data->total_cost }} 
                                    </td>
                                    <td>
                                    	

                                        
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
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__btns">
                        <a href=" {{ route('store.index') }} " class="primary-btn cart-btn">CONTINUE SHOPPING</a>

                        <input type="submit" name="submit" value="Update Cart" class="primary-btn cart-btn cart-btn-right">
                    </div>
                    </form>

                </div>
                <div class="col-lg-6">
                    <div class="shoping__continue">
                        <div class="shoping__discount">
                            <h5>Discount Codes</h5>
                            <form action="#">
                                <input type="text" placeholder="Enter your coupon code">
                                <button type="submit" class="site-btn">APPLY COUPON</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__checkout">
                        <h5>Cart Total</h5>
                        <ul>
                            <li>Total <span>ksh. {{ $total }} </span></li>
                        </ul>
                        <a href="#" class="primary-btn">PROCEED TO CHECKOUT</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

@stop

@section('footer')
	@include('frontend.footer')
@stop

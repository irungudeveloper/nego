@extends('frontend.main')

@section('navbar')
    @include('frontend.navbar')
@stop

@section('content')

	<div class="container pt-5">
		<div class="row">
			<div class="col-12 p-3">
				<h3 class="text-center">SELECT TYPE OF ACCOUNT YOU WISH TO CREATE</h3>
			</div>
			<div class="col-6 col-sm-12 col-lg-6">
				<div class="card">
					<div class="card-header">
						<h4 class="text-center card-title">Customer Account</h4>
					</div>
					<div class="card-body">
						<p>With this account, you will be able to</p>
						<ul>
							<li>Shop for the products available</li>
							<li>Negotiate the prices</li>
							<li>Get the service you deserve</li>
						</ul>
						<div class="row p-3">
							<div class="col-12 text-center">
								<a href=" {{ route('customer.create') }} " class="btn btn-solid btn-primary">Create Account</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-6 col-sm-12 col-lg-6">
				<div class="card ">
					<div class="card-header">
						<h4 class="text-center card-title">Merchant Account</h4>
					</div>
					<div class="card-body">
						<p>With this account, you will be able to</p>
						<ul>
							<li>Sell your merchandise to customers</li>
							<li>Negotiate the prices</li>
							<li>Build your own brand</li>
						</ul>
						<div class="row p-3">
							<div class="col-12 text-center">
								<a href=" {{ route('merchant.create') }} " class="btn btn-solid btn-primary">Create Account</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


@stop
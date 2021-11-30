@extends('frontend.main')

@section('navbar')
    @include('frontend.navbar')
@stop

@section('hero')
    @include('frontend.hero')
@stop

@section('content')



 <section class="featured spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>All Products</h2>
                    </div>
                    <div class="featured__controls">
                        <ul>
                            <li class="active" data-filter="*">All</li>
                            @forelse($category as $data)
                            
                            <li data-filter=".oranges">{{$data->category_name}}</li>
                            @empty
                            <li data-filter=".oranges">No data available</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row featured__filter">
                @forelse($products as $data)
                <div class="col-lg-3 col-md-4 col-sm-6 mix oranges fresh-meat">
                    <div class="featured__item">
                        <div class="featured__item__pic set-bg" data-setbg="{{asset('storage/images/'.$data->product_image)}}">
                            <ul class="featured__item__pic__hover">
                                <li><a href="{{ route('product.single',$data->id) }}"><i class="fa fa-eye"></i></a></li>
                                <!-- <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li> -->
                            </ul>
                        </div>
                        <div class="featured__item__text">
                            <h6><a href="#"> {{ $data->product_name }} </a></h6>
                            <h5>ksh. {{ $data->product_retail_price }}</h5>
                        </div>
                    </div>
                </div>
                @empty

                <div class="col-12 bg-secondary text-center">
                    <h4>No Products Avallable At The Moment, Try Again Later</h4>
                </div>

                @endforelse
            </div>
        </div>
    </section>
    @stop

    @section('footer')
        @include('frontend.footer')
    @stop
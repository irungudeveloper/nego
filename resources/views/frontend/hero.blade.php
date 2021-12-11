<section class="hero">



        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="hero__categories">
                        <div class="hero__categories__all bg-success">
                            <i class="fa fa-bars"></i>
                            <span>All categories</span>
                        </div>
                        <ul>

                        
                            @forelse($category as $data)
                            <li><a href="#">{{$data->category_name}}</a></li>
                            @empty
                            <li><a href="#">No Categories Avaliable</a></li>
                            @endforelse
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <!-- <div class="hero__search">
                        <div class="hero__search__form">
                            <form action="#">
                                <div class="hero__search__categories">
                                    All Categories
                                    <span class="arrow_carrot-down"></span>
                                </div>
                                <input type="text" placeholder="What do yo u need?">
                                <button type="submit" class="site-btn">SEARCH</button>
                            </form>
                        </div>
                        <div class="hero__search__phone">
                            <div class="hero__search__phone__icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="hero__search__phone__text">
                                <h5>+65 11.188.888</h5>
                                <span>support 24/7 time</span>
                            </div>
                        </div>
                    </div> -->
                    <div class="hero__item set-bg" data-setbg="{{asset('organi-asset/img/hero/banner-3.jpg')}}">
                        <div class="hero__text">
                            <span>NEGO E-COMM</span>
                            <h2 class="h2">We have what you need</h2>
                            
                            <a href="#" class="btn btn-solid btn-success">SHOP NOW</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
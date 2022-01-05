@extends('adminlte::page')

@section('title', 'NEGO | E-com')

@section('content_header')
    <h1 class="m-0 text-dark">Discount</h1>
    <p><a href="#">Dashboard</a>/<a href="#">Discount</a></p>
@stop

@section('content')

    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-center h4">Product Stock Graph</h4>
                </div>
                <div class="card-body">
                     <canvas id="productStockChart" width="200" height="200"></canvas>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-center h4">Product Sales Graph</h4>
                </div>
                <div class="card-body">
                    <canvas id="productSalesChart" width="200" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-center h4">Product Details Table</h4>
                </div>
                <div class="card-body">
                     <div class="row">
                        <div class="col-md-4 col-12 col-sm-12 col-lg-4 col-xs-4">
                            <div class="card">
                                <div class="card-body bg-info">
                                    <p><span class="h3"> {{ $total_products }} </span> Total Products</p>
                                </div>
                            </div>
                            
                        </div>
                        <div class="col-md-4 col-12 col-sm-12 col-lg-4 col-xs-4">
                            <div class="card">
                                <div class="card-body bg-success">
                                    <p><span class="h3"> {{ $available_products }} </span> Available Products</p>
                                </div>
                            </div>
                            
                        </div>
                        <div class="col-md-4 col-12 col-sm-12 col-lg-4 col-xs-4">
                            <div class="card">
                                <div class="card-body bg-primary">
                                    <p><span class="h3" > {{ $negotiable_products }} </span> Negotiable Products</p>
                                </div>
                            </div>
                            
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 pt-4 pb-3">
                            <table id="category_table" class="table table-hover table-responsive">
                  <thead>
                    <tr>
                      <th scope="col">Product Name</th>
                      <th scope="col">Product Image</th>
                      <th scope="col">Product Quantity</th>
                      <th scope="col">Units Sold</th>
                      <th scope="col">Product Price</th>
                      <th scope="col">Sales Amount</th>
                      <th scope="col">Negotiable</th>
                      <th scope="col">Availability Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($product_details as $data)
                    <tr>
                      <td scope="row">{{$data->product_name}}</td>
                      <td><img src="{{asset('storage/images/'.$data->product_image)}}" height="50px" width="50px"></td>
                      <td> {{$data->product_quantity}} </td>
                      <td> {{ $data->units_sold }} </td>
                      <td> {{ $data->product_price }} </td>
                      <td> {{ $data->sales_amount }} </td>
                      <td> 
                            @if($data->negotiable == 1) 
                                <button class="badge badge-success">Negotiable</button>
                            @else
                                <button class="badge badge-secondary">Not Negotiable</button>
                            @endif
                        </td>
                         <td> 
                            @if($data->availability_status == 1) 
                                <button class="badge badge-success">Available</button>
                            @else
                                <button class="badge badge-secondary">Not Available</button>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                      <td colspan="100%" class="text-center">No Product Data Found <a href="product/create" class="btn btn-solid btn-primary ">Add Product</a></td>
                    </tr>
                   @endforelse
                  </tbody>
            </table>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>

@stop

@section('js')
  
  <script type="text/javascript">

     $('#category_table').DataTable();

        $(document).ready(function()
        {
            console.log('ready');

            const ctx1 = document.getElementById('productStockChart').getContext('2d');

            //fetch product stock
            $.ajax(
            {
                url:' {{ route("chart.product.stock") }} ',
                method:'GET',
                dataType:'json',
                success:function(response)
                {
                    console.table(response);

                    const myChart = new Chart(ctx1, {
                        type: 'pie',
                        data: {
                            labels: response.labels,
                            datasets: [{
                                label: 'Product Stock',
                                data: response.values,
                                backgroundColor: [
                                     'rgb(255, 99, 132)',
                                      'rgb(54, 162, 235)',
                                      'rgb(255, 205, 86)',
                                      'rgb(255, 255, 86)',
                                      'rgb(255, 105, 86)',
                                      'rgb(255, 25, 86)',
                                ],
                            }]
                        }
                    });

                },
                error:function(response)
                {
                    console.log(response);
                }

            });

            //fetch product sales

            const ctx2  = document.getElementById('productSalesChart').getContext('2d');
            
            $.ajax(
            {
                url:' {{ route("chart.product.sale") }} ',
                method:'GET',
                dataType:'json',
                success:function(response)
                {
                    console.table(response);

                    const salesChart = new Chart(ctx2,{
                         type: 'bar',
                            data: {
                                labels: response.labels,
                                datasets: [{
                                    label: 'Sales Amount',
                                    data: response.values,
                                    backgroundColor: [
                                        'rgba(255, 99, 132, 0.2)',
                                        'rgba(54, 162, 235, 0.2)',
                                        'rgba(255, 206, 86, 0.2)',
                                        'rgba(75, 192, 192, 0.2)',
                                        'rgba(153, 102, 255, 0.2)',
                                        'rgba(255, 159, 64, 0.2)'
                                    ],
                                    borderColor: [
                                        'rgba(255, 99, 132, 1)',
                                        'rgba(54, 162, 235, 1)',
                                        'rgba(255, 206, 86, 1)',
                                        'rgba(75, 192, 192, 1)',
                                        'rgba(153, 102, 255, 1)',
                                        'rgba(255, 159, 64, 1)'
                                    ],
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: false
                                    }
                                }
                            }
                    });

                }
            });

        });    
  </script>

@stop
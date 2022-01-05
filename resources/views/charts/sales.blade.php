@extends('adminlte::page')

@section('title', 'NEGO | E-com')

@section('content_header')
    <h1 class="m-0 text-dark">Discount</h1>
    <p><a href="#">Dashboard</a>/<a href="#">Discount</a></p>
@stop

@section('content')
   <div class="row">
    @forelse($total_sales as $data)
       <div class="col-md-4 col-12 col-sm-12 col-lg-4 col-xs-4">
            <div class="card">
                <div class="card-body bg-info">
                    <p><span class="h3"> {{ $data->total_purchase }} </span> Total Revenue Spent</p>
                </div>
            </div>
            
        </div>
        <div class="col-md-4 col-12 col-sm-12 col-lg-4 col-xs-4">
            <div class="card">
                <div class="card-body bg-success">
                    <p><span class="h3"> {{ $data->total_sell }} </span> Total Income</p>
                </div>
            </div>
            
        </div>
        <div class="col-md-4 col-12 col-sm-12 col-lg-4 col-xs-4">
            <div class="card">
                <div class="card-body bg-primary">
                    <p><span class="h3" > {{ $data->total_profit }} </span> Gross Profit</p>
                </div>
            </div>
            
        </div>
       @empty
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
                <h4 class="text-center h4">No Data Available</h4>
            </div>
        </div>
       @endforelse
   </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-center h4">Sales By Product</h4>
                </div>
                <div class="card-body">
                     <canvas id="saleProductChart" width="200" height="200"></canvas>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-center h4">Discount Graph</h4>
                </div>
                <div class="card-body">
                    <canvas id="discountSaleChart" width="200" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>

@stop

@section('js')
  
    <script type="text/javascript">
        $(document).ready(function()
        {
             const ctx1 = document.getElementById('discountSaleChart').getContext('2d');

            //fetch product stock
            $.ajax(
            {
                url:' {{ route("sales.discount") }} ',
                method:'GET',
                dataType:'json',
                success:function(response)
                {
                    console.table(response);

                    const myChart = new Chart(ctx1, {
                        type: 'pie',
                        data: {
                            labels: response.label,
                            datasets: [{
                                label: 'Product Discount',
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

            const ctx2 = document.getElementById('saleProductChart').getContext('2d');

            $.ajax(
            {
                url: ' {{ route( "sales.product" ) }} ',
                method:'GET',
                dataType:'json',
                success:function(response)
                {
                    console.table(response);

                     const salesChart = new Chart(ctx2,{
                         type: 'bar',
                            data: {
                                labels: response.label,
                                datasets: [{
                                    label: 'Revenue Spent',
                                    data: response.revenue,
                                    backgroundColor:'rgba(54, 162, 235, 0.2)',
                                    borderColor:'rgba(54, 162, 235, 1)',
                                    borderWidth: 1
                                },

                                {
                                    label: 'Income Generated',
                                    data: response.income,
                                    backgroundColor:'rgba(255, 99, 132, 0.2)',
                                    borderColor:'rgba(255, 99, 132, 1)',
                                    borderWidth: 1
                                },

                                {
                                    label: 'Profits',
                                    data: response.profit,
                                    backgroundColor:'rgba(75, 192, 192, 0.2)',
                                    borderColor:'rgba(75, 192, 192, 1)',
                                    borderWidth: 1
                                }

                                ]
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: false
                                    }
                                }
                            }
                    });

                },
                error:function(response)
                {
                    console.table(response);
                }
            });

        });
    </script>

@stop
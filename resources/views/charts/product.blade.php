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

@stop

@section('js')
  
  <script type="text/javascript">
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
            

        });    
  </script>

@stop
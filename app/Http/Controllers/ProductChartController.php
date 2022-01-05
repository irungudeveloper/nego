<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

use Auth;
use DB;

use App\Charts\ProductChart;
use App\Models\Product;

class ProductChartController extends Controller
{
    //


    public function productChart()
    {
        return view('charts.product');
     
    }

    public function productStock()
    {
        // code...

        $product_stock = DB::table('product')
                            ->select(array('product_name', 'product_quantity'))
                            ->get();

        $label = array();
        $value = array();

        foreach ($product_stock as $data) 
        {
            // code...
            array_push($label, $data->product_name);
            array_push($value, $data->product_quantity);
        }

        return response()->json(['labels'=>$label,'values'=>$value]);

    }

    public function productSale()
    {
        // code...

        $product_sales = DB::table('product')
                            ->join('orders','product.id','=','orders.product_id')
                            ->groupBy('product.id')
                            ->sum('orders.amount');

        return response()->json($product_sales);                    
    }

}

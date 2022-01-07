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

        $total_products = Product::where('user_id',Auth::user()->id)->count();
        $negotiable_products = Product::where('user_id',Auth::user()->id)
                                            ->where('negotiable',1)
                                            ->count();
        $available_products = Product::where('user_id',Auth::user()->id)
                                        ->where('availability_status',1)
                                        ->count();

        $product_details = DB::select(
                            DB::raw("SELECT product.id, product.product_name, product.product_image, product.product_quantity, COALESCE(SUM(orders.quantity),0) AS units_sold, COALESCE(SUM(orders.amount),0) AS sales_amount , product.negotiable, product.availability_status, product.product_price
                                FROM product
                                LEFT JOIN orders ON product.id = orders.product_id
                                GROUP BY orders.product_id;
                                    "
                            ));
        

        // return response()->json($product_details);

        return view('charts.product')->with('total_products',$total_products)
                                    ->with('negotiable_products',$negotiable_products)
                                    ->with('available_products',$available_products)
                                    ->with('product_details',$product_details);

     
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

        $product_sales = DB::select(
                            DB::raw(
                                "SELECT product.id, product.product_name, SUM(orders.amount) AS productsale 
                                FROM product
                                INNER JOIN orders ON orders.product_id = product.id
                                GROUP BY product.id
                                ORDER BY product.id;"
                        ));

        $label = array();
        $values = array();

        foreach($product_sales as $data)
        {
            array_push($label, $data->product_name);
            array_push($values, $data->productsale);
        }

        return response()->json([
                                    'labels'=>$label,
                                    'values'=>$values
                                ]);                    
    }

}

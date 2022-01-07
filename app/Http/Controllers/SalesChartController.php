<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use DB;

use App\Models\Product;

class SalesChartController extends Controller
{
    //

    public function index()
    {
        // code...
        $total_sales = DB::select(
                       DB::raw("
                            SELECT SUM(total_purchase_price) AS total_purchase, SUM(total_selling_price) AS total_sell, SUM(total_profit) AS total_profit FROM (SELECT product.product_name, product.product_price*product.product_quantity AS total_purchase_price, SUM(orders.amount) AS total_selling_price, (SUM(orders.amount)-product.product_price*product.product_quantity) AS total_profit FROM product LEFT JOIN orders ON product.id = orders.product_id GROUP BY product.id ORDER BY product.id) AS sales_table
                        "));

        return view('charts.sales')->with('total_sales',$total_sales);
    }

    public function totalSales()
    {
        $total_sales = DB::select(
                       DB::raw("
                            SELECT SUM(total_purchase_price) AS total_purchase, SUM(total_selling_price) AS total_sell, SUM(total_profit) AS total_profit FROM (SELECT product.product_name, product.product_price*product.product_quantity AS total_purchase_price, SUM(orders.amount) AS total_selling_price, (SUM(orders.amount)-product.product_price*product.product_quantity) AS total_profit FROM product LEFT JOIN orders ON product.id = orders.product_id GROUP BY product.id ORDER BY product.id) AS sales_table
                        "));
        
        $label = array();
        $value = array();

        // foreach($total_sales as $data)
        // {
        //     array_push($label,)
        // }

        return response()->json(['data'=>$total_sales]);
    }

    public function salesByProduct()
    {
        // code...

        $product_sales = DB::select(
                         DB::raw("
                                SELECT product.product_name, COALESCE(product.product_price*product.product_quantity,0) AS total_purchase_price, COALESCE(SUM(orders.amount),0) AS total_selling_price, COALESCE((SUM(orders.amount)-product.product_price*product.product_quantity),0) AS total_profit FROM product LEFT JOIN orders ON product.id = orders.product_id GROUP BY product.id ORDER BY product.id
                            "));

        $label = array();
        $revenue = array();
        $income = array();
        $profit = array();

        foreach ($product_sales as $data) 
        {
            // code...
            array_push($label,$data->product_name);
            array_push($revenue,(int)$data->total_purchase_price);
            array_push($income,(int)$data->total_selling_price);
            array_push($profit,(int)$data->total_profit);
        }

        return response()->json([
                                    'label'=>$label,
                                    'revenue'=>$revenue,
                                    'income'=>$income,
                                    'profit'=>$profit
                                ]);
    }

    public function productDiscount()
    {
        // code...

        $product_discount = DB::select(
                            DB::raw("
                                   SELECT product.id,product.product_name, AVG(discount.percentage) AS average_discount
                                    FROM product
                                    INNER JOIN discount ON product.id = discount.product_id
                                    GROUP BY product.id
                                    ORDER BY product.id
                                "));   
        $label = array();
        $value = array();

        foreach($product_discount as $data)
        {
            array_push($label,$data->product_name);
            array_push($value,(int)$data->average_discount);
        }     

        return response()->json(['label'=>$label,'values'=>$value]);

    }


}

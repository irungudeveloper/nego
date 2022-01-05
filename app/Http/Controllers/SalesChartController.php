<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use DB;

use App\Models\Product;

class SalesChartController extends Controller
{
    //

    public function total_sales()
    {
        $total_sales = DB::select(
                       DB::raw("
                            SELECT SUM(total_purchase_price) AS total_purchase, SUM(total_selling_price) AS total_sell, SUM(total_profit) AS total_profit FROM (SELECT product.product_name, product.product_price*product.product_quantity AS total_purchase_price, SUM(orders.amount) AS total_selling_price, (SUM(orders.amount)-product.product_price*product.product_quantity) AS total_profit FROM product INNER JOIN orders ON product.id = orders.product_id GROUP BY product.id ORDER BY product.id) AS sales_table
                        "));

        return response()->json(['data'=>$total_sales]);
    }

    public function sales_by_product()
    {
        // code...

        $product_sales = DB::select(
                         DB::raw("
                                SELECT product.product_name, COALESCE(product.product_price*product.product_quantity,0) AS total_purchase_price, COALESCE(SUM(orders.amount),0) AS total_selling_price, COALESCE((SUM(orders.amount)-product.product_price*product.product_quantity),0) AS total_profit FROM product LEFT JOIN orders ON product.id = orders.product_id GROUP BY product.id ORDER BY product.id
                            "));

        return response()->json(['data'=>$product_sales]);
    }

    public function product_discount()
    {
        // code...

        $product_discount = DB::select(
                            DB::raw("
                                    SELECT product.product_name, discount.id, COALESCE(SUM(product.product_retail_price*(discount.percentage/100)),0) AS discount_amount, COUNT(discount.id) AS discount_count
                                    FROM product
                                    LEFT JOIN discount ON product.id = discount.product_id
                                    WHERE discount.active = 0
                                    GROUP BY discount.product_id
                                    ORDER BY discount.product_id
                                "));        

        return response()->json(['data'=>$product_discount]);

    }

}

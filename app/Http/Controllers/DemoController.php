<?php

namespace App\Http\Controllers;

use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\DB;

class DemoController extends Controller
{
    //retrieve All Data
    public function retrieveAllData()
    {
        $data = DB::table('users')->get();
        return $data;
    }

    //retrieve single Data
    public function retrieveSingleData()
    {
        //ritrieve first row
        $data = DB::table('users')->first();

        //ritrieve one row any where
        $data = DB::table('users')->find('10');

        return $data;
    }

    //retrieve single cloumn
    public function retrieveColumn()
    {
        //ritrieve column
        $data = DB::table('users')->pluck('name');

        //ritrieve column but as like key valu
        $data = DB::table('brands')->pluck('brand_img', 'brand_name');
        // here key is catrgory_name and value is category_img
        return $data;
    }

    //retrieve Aggregates method
    public function retrieveAggregates()
    {
        $count = DB::table('products')->count('price');
        $min = DB::table('products')->min('price');
        $max = DB::table('products')->max('price');
        $avg = DB::table('products')->avg('price');
        $sum = DB::table('products')->sum('price');
        return ['count' => $count, 'min' => $min, 'max' => $max, "avarage" => $avg, "sum" => $sum];
    }

    //select clause
    public function sekectClause()
    {
        $data = DB::table('brands')->select('brand_name')->get();
        return $data;
    }

    //select clause but unique value
    public function sekectClauseUniqque()
    {
        $data = DB::table('brands')->select('brand_name')->distinct()->get();
        return $data;
    }

    //Inner Joine
    public function innerJoin()
    {
        $data = DB::table('products')->join('brands', 'products.brand_id', '=', 'brands.id')->join('categories', 'products.category_id', '=', 'categories.id')->get();
        return $data;
    }

    //Left Joine
    public function leftJoin()
    {
        $data = DB::table('products')->leftJoin('brands', 'products.brand_id', '=', 'brands.id')->leftJoin('categories', 'products.category_id', '=', 'categories.id')->get();
        return $data;
    }

    //right Joine
    public function rightJoin()
    {
        $data = DB::table('products')->rightJoin('brands', 'products.brand_id', '=', 'brands.id')->rightJoin('categories', 'products.category_id', '=', 'categories.id')->get();
        return $data;
    }

    //cross Joine
    public function crossJoin()
    {
        $data = DB::table('products')->crossJoin('brands')->get();
        return $data;
    }

    //advance JoinClause
    public function advanceJoinClause()
    {
        $data = DB::table('products')
            ->join("brands", function (JoinClause $joine) {
                $joine->on('products.brand_id', '=', 'brands.id')
                    ->where('products.title', '=', 'milk');
            })->get();
        return $data;
    }

    //Union Joine
    public function unionJoin(){
        $query1 = DB::table('products')->where('title','=', 'milk');
        $query2 = DB::table('products')->where('price','=', '20')->union($query1)->get();
        return $query2;
    }
}

<?php

namespace App\Http\Controllers;

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
        return ['count'=>$count, 'min'=>$min, 'max' => $max, "avarage"=>$avg,"sum"=>$sum];
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
    public function innerJoin()
    {
       $data = DB::table('products')->join('brands','products.brand_id','=', 'brands.id')->join('categories', 'products.category_id', '=', 'categories.id')->get();
       return $data;
    }
}

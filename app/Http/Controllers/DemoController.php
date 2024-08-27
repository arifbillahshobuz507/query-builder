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

    //Basic Where Clauses
    public function basicWhereClauses(){
        $data = DB::table('products')->where('products.price','>', '100')->get();
        $data = DB::table('products')->where('products.price','>=', '100')->get();
        $data = DB::table('products')->where('products.price','<', '100')->get();
        $data = DB::table('products')->where('products.price','<=', '100')->get();
        $data = DB::table('products')->where('products.price','!=', '100')->get();
        $data = DB::table('products')->where('products.title','LIKE', '%A%')->get();
        $data = DB::table('products')->where('products.title','NOT LIKE', '%A%')->get();


        return $data;
    }


    //advance Where Clauses
    public function advanceWhereClauses(){
        //orWhere
        $data = DB::table('products')->where('products.price','=', '300')->orWhere('products.price','=', '5000')->get();

        // where not
        $data = DB::table('products')->where('products.price','=', '300')->WhereNot('products.price','=', '5000')->get();

        //where between
        $data = DB::table('products')->whereBetween('products.price',['300','400'])->get();

        //where not between
        $data = DB::table('products')->whereNotBetween('products.price',['300','400'])->get();

        //where null
        $data = DB::table('products')->whereNull('products.price')->get();

        //where not null
        $data = DB::table('products')->whereNotNull('products.price')->get();

        //where in
        $data = DB::table('products')->whereIn('products.price','=', '200')->get();

        //where not in
        $data = DB::table('products')->whereNotIn('products.price','=', '200')->get();

        //where date
        $data = DB::table('categories')->whereDate('created_at','2024-08-07')->get();

        //where month
        $data = DB::table('categories')->whereMonth('created_at','01')->get();

        //where day
        $data = DB::table('categories')->whereDay('created_at','22')->get();

        //where year
        $data = DB::table('categories')->whereYear('created_at','2002')->get();

        //where time
        $data = DB::table('categories')->whereTime('created_at','04:09:49')->get();

        //where cloumn
        $data = DB::table('categories')->whereColumn('created_at','<','updated_at')->get();
        $data = DB::table('products')->whereColumn('products.price','<','products.discount')->get();


        return $data;
    }

    //order by ascending
    public function orderByAscending(){
        $data = DB::table('brands')->orderBy('brand_name','asc')->get();
        return $data;
    }
}

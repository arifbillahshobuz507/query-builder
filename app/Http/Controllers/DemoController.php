<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\JoinClause;

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
    public function unionJoin()
    {
        $query1 = DB::table('products')->where('title', '=', 'milk');
        $query2 = DB::table('products')->where('price', '=', '20')->union($query1)->get();
        return $query2;
    }

    //Basic Where Clauses
    public function basicWhereClauses()
    {
        $data = DB::table('products')->where('products.price', '>', '100')->get();
        $data = DB::table('products')->where('products.price', '>=', '100')->get();
        $data = DB::table('products')->where('products.price', '<', '100')->get();
        $data = DB::table('products')->where('products.price', '<=', '100')->get();
        $data = DB::table('products')->where('products.price', '!=', '100')->get();
        $data = DB::table('products')->where('products.title', 'LIKE', '%A%')->get();
        $data = DB::table('products')->where('products.title', 'NOT LIKE', '%A%')->get();


        return $data;
    }


    //advance Where Clauses
    public function advanceWhereClauses()
    {
        //orWhere
        $data = DB::table('products')->where('products.price', '=', '300')->orWhere('products.price', '=', '5000')->get();

        // where not
        $data = DB::table('products')->where('products.price', '=', '300')->WhereNot('products.price', '=', '5000')->get();

        //where between
        $data = DB::table('products')->whereBetween('products.price', ['300', '400'])->get();

        //where not between
        $data = DB::table('products')->whereNotBetween('products.price', ['300', '400'])->get();

        //where null
        $data = DB::table('products')->whereNull('products.price')->get();

        //where not null
        $data = DB::table('products')->whereNotNull('products.price')->get();

        //where in
        $data = DB::table('products')->whereIn('products.price', '=', '200')->get();

        //where not in
        $data = DB::table('products')->whereNotIn('products.price', '=', '200')->get();

        //where date
        $data = DB::table('categories')->whereDate('created_at', '2024-08-07')->get();

        //where month
        $data = DB::table('categories')->whereMonth('created_at', '01')->get();

        //where day
        $data = DB::table('categories')->whereDay('created_at', '22')->get();

        //where year
        $data = DB::table('categories')->whereYear('created_at', '2002')->get();

        //where time
        $data = DB::table('categories')->whereTime('created_at', '04:09:49')->get();

        //where cloumn
        $data = DB::table('categories')->whereColumn('created_at', '<', 'updated_at')->get();
        $data = DB::table('products')->whereColumn('products.price', '<', 'products.discount')->get();


        return $data;
    }

    //order by ascending
    public function orderByAscending()
    {
        $data = DB::table('brands')->orderBy('brand_name', 'asc')->get();
        return $data;
    }
    //order by descending
    public function orderByDescending()
    {
        $data = DB::table('categories')->orderBy('catrgory_name', 'desc')->get();
        return $data;
    }

    //order by Random
    public function orderByRandom()
    {
        $data = DB::table('categories')->inRandomOrder()->get();
        $data = DB::table('categories')->inRandomOrder()->first();
        return $data;
    }

    //order by skip and take
    public function orderBySkipTake()
    {
        $data = DB::table('brands')->skip('100')->take('700')->get();
        return $data;
    }

    //Group by
    public function groupBy()
    {
        $data = DB::table('products')->groupBy('price')->get();
        return $data;
        //if face this error {{ SQLSTATE[42000]: Syntax error or access violation: 1055 Expression #1 of SELECT list is not in GROUP BY clause and contains nonaggregated column 'module_11_pre.products.id' which is not functionally dependent on columns in GROUP BY clause; this is incompatible with sql_mode=only_full_group_by (Connection: mysql, SQL: select * from `products` group by `price`) }}}}
        //go to your config file than
        //go database than
        //go your database and see `'strict'=> false` than .  {{  i mean if your database is sqlite so you see `'strict'=> false` OR you use mysql so you see `'strict'=> false`}}
        //change `'strict'=> true`
        // or see `'strict'=> false` than you change `'strict'=> true`
    }

    //Group by Having
    public function groupByHaving()
    {
        $data = DB::table('products')->groupBy('price')->having('price', '=', '100')->get();
        return $data;
        //if face this error {{ SQLSTATE[42000]: Syntax error or access violation: 1055 Expression #1 of SELECT list is not in GROUP BY clause and contains nonaggregated column 'module_11_pre.products.id' which is not functionally dependent on columns in GROUP BY clause; this is incompatible with sql_mode=only_full_group_by (Connection: mysql, SQL: select * from `products` group by `price`) }}}}
        //go to your config file than
        //go database than
        //go your database and see `'strict'=> false` than .  {{  i mean if your database is sqlite so you see `'strict'=> false` OR you use mysql so you see `'strict'=> false`}}
        //change `'strict'=> true`
        // or see `'strict'=> false` than you change `'strict'=> true`
    }

    // insert data
    public function insertData(Request $request): JsonResponse
    {
        try {
            $data = DB::table('brands')
                ->insert([
                    "brand_img" => $request->input('img'),
                    "brand_name" => $request->input('name')
                ]);
            return response()->json([
                "sataus" => "Success",
                "message" => "Data create Successfully"
            ], 200);
        } catch (Exception $exception) {
            return response()->json([
                "sataus" => "Fail",
                "message" => $exception->getMessage()
            ], 200);
        }
    }

    //update data
    public function updateData(Request $request): JsonResponse
    {
        try {
            $data = DB::table("products")
                ->where("id", "=", $request->id)
                ->update([
                    "title" => $request->input("title"),
                    "discount_price" => $request->input("discount_price")
                ]);
            return response()->json([
                "status" => "Success",
                "message" => "Data Update Succefully"
            ], 200);
        } catch (Exception $exception) {
            return response()->json([
                "status" => "Fail",
                "message" => $exception->getMessage()
            ], 200);
        }
    }
    public function updateOrInsertData(Request $request): JsonResponse
    {
        try {
            $data = DB::table('brands')
                ->updateOrInsert(
                    [
                        'brand_name' => $request->input('brand_name'),
                        'brand_img' => $request->input('brand_img'),
                    ]
                );
            dd($request->brand_name);
            return response()->json([
                "status" => "Success",
                "message" => "Data Create Or Update Succefully"
            ], 200);
        } catch (Exception $exception) {
            return response()->json([
                "status" => "Fail",
                "message" => $exception->getMessage()
            ], 200);
        }
    }
    //increment
    public function incrementData(Request $request)
    {
        try {
            $data = DB::table('products')
                ->where('id', '=', $request->id)
                ->increment('price', 1);
            return response()->json([
                "status" => "Success",
                "message" => "Data Increment Succefully"
            ],200);
        } catch (Exception $exception) {
            return response()->json([
                "status" => "Fail",
                "message" => "Somthing is wrong ". $exception->getMessage()
            ],200);
        }
    }

    //decrement
    public function decrementData(Request $request){
        try{
            $data = DB::table("products")
            ->where("id","=", $request->id)
            ->decrement("price",1);
            return response()->json([
                "status"=>"Success",
                "message"=>"Data Decrement Succefully"
            ]);
        } catch(Exception $exception){
            return response()->json([
                "status"=>"Fail",
                "message"=>"Somthing is wrong",  $exception->getMessage()
            ],200);
        }
    }
// Delete Data
    public function deleteData(Request $request){
        try{
            $data = DB::table("brands")
            ->where("id","=", $request->id)
            ->delete();
            return response()->json([
                "status"=>"Succress",
                "message"=>"Delete Successfuylly"
            ],200);
        } catch(Exception $exception){
            return response()->json([
                "status"=>"Fail",
                "message"=>"Somthing is Wrong". $exception->getMessage()
            ],200);
        }
    }
}

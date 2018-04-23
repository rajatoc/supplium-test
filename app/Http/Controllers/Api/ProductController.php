<?php

namespace App\Http\Controllers\Api;

use App\Product;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Request as UriRequest;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $product_list = Product::all();
        return ['product_list' => $product_list];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
       // var_dump($input); die();
        $product = new Product;
        $product->name = $request['name'];
        $product->description = $request['description'];
        $product->price = $request['price'];
        $product->unit = $request['unit'];
        $product->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         
        $product_detail = Product::find($id);
        return ['product_list' => $product_detail];
    }
    public function assignCategories(Request $request) {
      
        $product_id =UriRequest::segment(2);
        
        if ($request['category_id']) {
            $product = Product::find($product_id);
            $category = Category::find($request['category_id']);
            $product_category = array(
                'category_id' => $request['category_id'],
            );
           $result = $product->categories()->attach($product_id, $product_category);
           echo "Done---". $result;

        }
    }
    public function categories($id)
    {
        $product_detail = Product::find($id);
        $product_categories = array();
        foreach ($product_detail->categories as $category)
        {
            $details= array(
                'name' =>  $category->name,
                'category_id'  =>  $category->pivot->category_id,
                
            );
            
            array_push($product_categories, $details);
        }
        return ['product_categories' => $product_categories];
        //var_dump($company_detail->products);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
public function update(Request $request, $id)
    {
        if ($id) {
            $product_detail = Product::find($id);
            //var_dump($request['name']); die();
            if ($product_detail) {
               $product_detail->name = (isset($request['name']) && !empty($request['name'])) ? $request['name'] : $product_detail->name;
               $product_detail->save();
            }
            return ['product' => $product_detail];
        }else {
            var_dump("hello"); die();
        } 
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

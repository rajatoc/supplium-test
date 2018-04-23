<?php

namespace App\Http\Controllers\Api;

use App\Company;
use App\Product;
use App\CompanyProducts;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Request as UriRequest;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $company_list = Company::all();
        return ['company_list' => $company_list];
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
        $company = new Company;
        $company->name = $request['name'];
        $company->save();
    }
    public function assignProduct(Request $request)
    {
        $company_id =UriRequest::segment(2);
       // var_dump($input); die();
        if ($request['product_id']) {
            $product = Product::find($request['product_id']);
            $company = Company::find($company_id);
            $company_product = array(
                'product_id' => $request['product_id'],
                'qty'        => $request['qty'],
                'price'      => $request['price']
            );
           $result = $company->products()->attach($company_id, $company_product);
           echo "Done---". $result;

        }
       
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         
        $company_detail = Company::find($id);
        return ['company_list' => $company_detail];
    }

    public function products($id)
    {
        $company_detail = Company::find($id);
        $company_products = array();
        foreach ($company_detail->products as $product)
        {
            $details= array(
                'name' => $product->name,
                'qty'  =>  $product->pivot->qty,
                'price' => $product->pivot->price,
                'company_name' => $company_detail->name
            );
            
            array_push($company_products, $details);
        }
        return ['company_products' => $company_products];
        //var_dump($company_detail->products);
    }

    public function users($id)
    {
        $company_detail = Company::find($id);
        $company_users = array();
        foreach ($company_detail->users as $user)
        {
            //echo $user->pivot->role_id."<br>";
            $details= array(
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'email'  =>  $user->email,
                'phone' => $user->phone,
                'role_id' => $user->pivot->role_id,
                'company_name' => $company_detail->name
            );
            
            array_push($company_users, $details);
        }
        return ['company_users' => $company_users];
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
            $company_detail = Company::find($id);
            //var_dump($request['name']); die();
            if ($company_detail) {
               $company_detail->name = (isset($request['name']) && !empty($request['name'])) ? $request['name'] : $company_detail->name;
               $company_detail->save();
            }
            return ['company' => $company_detail];
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

<?php

namespace App\Http\Controllers;

use App\Products;
use App\Repositories\ProductsInterface;
use Illuminate\Http\Request;

class ProductsController extends Controller
{

    protected $products;

    public function __construct(ProductsInterface $products)
    {
        $this->products = $products;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $product = $this->products->getAllProducts();
        return response()->json($product);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        return $this->products->storeNewProduct($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return $this->products->getProductByID($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit(Products $products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Products  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return $this->products->updateProduct($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Products  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    /**
     * softDelete a Product ...
     * @param  \App\Products  $id
     */
    public function softDeleteAProduct($id)
    {
        return $this->products->softDeleteAProduct($id);
    }

    public function productsWithTrashed()
    {
        return $this->products->productsWithTrashed();
    }
    /**
     * forceDelete to Products
     * @param  \App\Products  $id
     */
    public function forceDeleteProduct($id)
    {
        return $this->products->forceDeleteProduct($id);
    }

    /**
     * restore to Products
     * @param  \App\Products  $id
     */
    public function restoreProduct($id)
    {
        return $this->products->restoreProduct($id);
    }

    /**
     * Request a product
     * @param  \Illuminate\Http\Request  $request
     */
    public function userAddRequestOfProduct(Request $request)
    {
        return $this->products->userAddRequestOfProduct($request);
    }

    /**
     * get all products by clints
     */
    public function showproductbyclints()
    {
        return $this->products->showproductbyclints();
    }
    
}

<?php

namespace App\Repositories;

use Illuminate\Http\Request;

interface ProductsInterface
{

    /**
     * Display All Products where status published
     */
    public function getAllProducts();
    /**
     * show details product by id to all
     * @param  \App\Products  $id
     */
    public function getProductByID($id);
    /**
     * Display Products Admin in session .
     */
    public function showAllProductsUser();
    /**
     * Store a new product by Admin .
     * @param  \Illuminate\Http\Request  $request
     */
    public function storeNewProduct(Request $request);
    /**
     * Request a product
     * @param  \Illuminate\Http\Request  $request
     */
    public function userAddRequestOfProduct(Request $request);
    /**
     * softDelete a Product ...
     * @param  \App\Products  $id
     */
    public function softDeleteAProduct($id);
    /**
     * get with Trashed Products ..
     */
    public function productsWithTrashed();

    /**
     * forceDelete to Products
     * @param  \App\Products  $id
     */
    public function forceDeleteProduct($id);

    /**
     * restore to Products
     * @param  \App\Products  $id
     */
    public function restoreProduct($id);
    /**
     * update a products
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Products  $id
     */
    public function updateProduct(Request $request, $id);

    /**
     * get all products by clints
     */
    public function showproductbyclints();
}

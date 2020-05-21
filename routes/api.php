<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

//Auth Details User :) in session .

use Illuminate\Http\Request;

/**
 * Admin Links :) ...
 */

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Register .

Route::group(['prefix' => 'auth', 'namespace' => 'Api\Auth'], function () {
    Route::post('register', 'RegisterController@register');
});

Route::group(['prefix' => 'product', 'middleware' => 'auth:api'], function () {

    // /**Products */
    // //All products .

    //Add product .
    Route::post('/addProduct', 'ProductsController@store');

    //SoftDelete
    Route::post('/softdeleteprdouct/{id}', 'ProductsController@softDeleteAProduct');

    //WithTrashed
    Route::post('/productstrashed', 'ProductsController@productsWithTrashed');

    //forcDelete
    Route::delete('/productforcedelete/{id}', 'ProductsController@forceDeleteProduct');

    //resore
    Route::post('/restoreproduct/{id}', 'ProductsController@restoreProduct');

    //show Product
    Route::get('/showproduct/{id}', 'ProductsController@show');

    //Update product
    Route::post('/updateproduct/{id}', 'ProductsController@update');

    //all products by clints
    Route::get('/showproductbyclints', 'ProductsController@showproductbyclints');
});

Route::middleware(['admin', 'auth:api'])->group(function () {

    //show all users ...
    Route::get('/allusers', 'UsersController@showAllUsers');

    //orders ...
    // update a status of order ...
    Route::post('changestatusorder/{id}', 'OrdersController@changeStatusOrder');
    // All Orders
    Route::get('/allorders', 'OrdersController@index');
    // Get all ogders Trashed
    Route::get('ordertrashed','OrdersController@getAllTrashed');
    
    //Restore a order in trashed .... 
    Route::post('/restoreorder/{id}','OrdersController@restoreOrder');

    //ForceDelete order
    Route::delete('forcdeleteorder/{id}','OrdersController@forcDeleteOrder');

});

/*=========//API Admin Exit//======*/

//TOWs :) .


    //**Products */
    //Show All Products
    Route::get('/products', 'ProductsController@index');

    //**Orders */
    //show Details orders ...
    Route::get('singleorder/{id}', 'OrdersController@show');

     //SoftDelete to order .
     Route::post('deletebyuser/{id}','OrdersController@destroy');

     Route::get('/', 'ProductsController@index');


/**
 * Users Links :)
 */

Route::middleware(['user', 'auth:api'])->group(function () {
    Route::get('product', 'ProductsController@index');

    //    Route::post('','');
    //    Route::get('','');

    //Request a product
    Route::post('userrequestproduct', 'ProductsController@userAddRequestOfProduct');

    //update a order ...
    Route::post('/updateorder/{id}', 'OrdersController@update');

    //Get All Orders :...
    Route::get('myorders', 'OrdersController@getClintOrders');

    //store new order
    Route::post('/neworder', 'OrdersController@storeNewOrder');

   

});

/**
 *
 * token :
 * admin :
eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIyIiwianRpIjoiZmM5ZjViZmZmNGRiNWM4NmJmYWE3ODljMzczNDcxM2VkYzZjYjI1Y2JmNjYyMzJjZjQ0ODA4ZDAwMzUzMTAxNDVmMTRiOTRmZGEzM2E1ZjciLCJpYXQiOjE1ODk5MDcxNTgsIm5iZiI6MTU4OTkwNzE1OCwiZXhwIjoxNjIxNDQzMTU4LCJzdWIiOiIxMiIsInNjb3BlcyI6W119.2IcKsSWC-kmI1mhLw1NrVhw9dtIMXXyCZ09ogHjJ6nPPfJN7xMD2lq18U824a2iaMCXgJyuNrrD5seSNEJxRn0XXHsie34P1BDONt5_WTt_D0syTZ1FUlmWxXuutghOeOfSI8ty8YrBv8vqPoXBE5geit3cgjMsIz4EbQK5-YzKi7779w8zzsaN7TmBqalgxjqqDqhrfFFPhSqBTntCNiE3KmYvxa-ElGtCL9-YFYmG6n2-CgV_wQweqrv8aQx0eC8eHv3YocfPUgsO8npCW7xHGfsUwayTMfBTnBy-0HiPrt1oJk47nNlqRCl9fvk2BTKxr8oiRBrVoT3YDQsw4w_0aeYEeV8VLrhro_l4mByoehIWp5mi9Zx6mvzJfWtenfssF27lLJ54qfzT350mAKf0mSvTkHTgCR6fp9FEJ-haGv3UdJBAMj4s6NBRxY4Qmh0RQcpN1yhXg3PQJLuyljs-8etOfJCuxqJUroycBqaJz88L6Gbk9G1xidmHr6UzpycNpWlWJsVSfIYn--o8Nj5Rc6BagoMC4d32QOfS_sbIcDKGRtDKP7udryOll840PjLgmNR1-uL5oY2gikiaAH1y47f41Umsf0WPG-4xdVkNVjDt2hbw1JANPu-Ql9t_VdTF-dgjavFzIPfTREKF4folgE_tu3DlPcbf-kml__zo

 * user :
eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIyIiwianRpIjoiODJkMWUwYTM4YWFkM2VmMWI1ZTUyNmMzZmJhZjQ0YmQ4NDc0NTNmZGY4YzVjMjliMTQ2MjQ2YjAxZGNhMDE5NTM5MjExNDgyMmM5YzQ0N2QiLCJpYXQiOjE1ODk5MDcxOTcsIm5iZiI6MTU4OTkwNzE5NywiZXhwIjoxNjIxNDQzMTk3LCJzdWIiOiIxMSIsInNjb3BlcyI6W119.G07gTWeWuQJ5ZoBU6-_f77NdFKfD1kclZKNJq3Ax66s6bWanpL_SwvPrB9XCGuI7xaXQzo600pHW7nKoQn4j5IfGQoIpXVqHDZ4dqNXYWG3ns-exa99s4x266FyL80TdjTf1aNc4JoCFGTKxmw69bSgSb2XsBeJuPecRNt_oaLhjbXg8OlhaYh9Em49ZE2QOBhC_EsSvJboGWwJCwD2lj9Rd_vmHXjne4zvzOFJqQ3mBmBQ-qMHsOFks3fR-_DNJI20A_rU1byS5vDsA_CuyBu4FBjVJ2wvIix5xnZOzEUp6LD9jKV4mufI2cAlp19dKU4HVm3LXUU1mlHpRiHcMqHf0IeIcReCZgECOLsnkpcfABjj3MBPgOadp9S-F7rZv8gt2cveYWm_Zvvh95PK5JeXVMMcJvOq0TI0vHqeG1b8SAOIILcJyO3qweS-EViJ2ODds2MntwX0teMXLaCtAzxOUlugN9qbKD_wtxA6g4tl75HKXE-1xPCC9bbJjHIy9aoo8260L7dc5wuATQLN5lWrHZoDfhm93KO9sZarrHhqAsxTYRa5e7mHPKHpj-HFf9WArtm0ruveBwc7xQHO9qCpw2EFg6dtisYXQaZI6o-fjo2oFK7GrH-ZUIrK1l_z7WyuFj2zwCk5xasjml-5iTXATjFP9ZMpC17CWcI2qsuE

 *
 */
/*=========//API Users Exit//======*/

//link to set a details user to get product .

//set status to product just to admin .

//All Orders .

//new Order .

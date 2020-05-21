<?php

namespace App\Http\Controllers;

use App\Orders;
use App\Repositories\OrdersInterface;
use Illuminate\Http\Request;

class OrdersController extends Controller
{

    protected $orders;

    public function __construct(OrdersInterface $orders)
    {
        $this->orders = $orders;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return $this->orders->getAllOrders();
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
        $orders = $this->orders->storeNewOrder($request);
        return $orders;

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return $this->orders->showOrderWithId($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function edit(Orders $orders)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        return $this->orders->updateOrder($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        return $this->orders->softDeleteOrder($id);
    }

    public function changeStatusOrder(Request $request, $id)
    {
        return $this->orders->changeStatusOrder($request, $id);
    }

    /**
     * show order for this clint in session
     */
    public function getClintOrders()
    {
        return $this->orders->getClintOrders();
    }

    /**
     * Store a Order just to Users .
     * @param  \Illuminate\Http\Request  $request
     */
    public function storeNewOrder(Request $request)
    {
        //
        return $this->orders->storeNewOrder($request);
    }

    /**
     * Get All Trashed
     */
    public function getAllTrashed()
    {
        //
      return  $this->orders->getAllwithTrashed();
    }

    public function restoreOrder($id)
    {
        //
        $this->orders->restoreOrderWithId($id);
    }
        /**
     * Force Delete  Order by admin or User
     * @param  \App\Orders  $id
     */
    public function forcDeleteOrder($id){
        //
        $this->orders->forcDeleteOrderWithId($id);

    }
}

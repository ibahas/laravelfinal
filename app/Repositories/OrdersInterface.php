<?php

namespace App\Repositories;

use Illuminate\Http\Request;

interface OrdersInterface
{

    /**
     * Display  All Orders to applicant or Admin ...
     */

    public function getAllOrders();
    /**
     * Display Order to applicant or Admin ...
     * @param  \App\Orders  $id
     */

    public function showOrderWithId($id);

    /**
     * Store a Order just to Users .
     * @param  \Illuminate\Http\Request  $request
     */
    public function storeNewOrder(Request $request);

    /**
     * delete a order go to trashed .
     * @param  \App\Orders  $id
     */
    public function deleteOrder($id);

    /**
     * Display All Trashed Orders .
     */
    public function getAllwithTrashed();

    /**
     * Resore Order
     * @param  \App\Orders  $id
     */

    public function restoreOrderWithId($id);

    /**
     * Force Delete  Order by admin or User
     * @param  \App\Orders  $id
     */
    public function forcDeleteOrderWithId($id);

    /**
     * Change Status Order With admin.
     * @param  \App\Orders  $id
     * @param  \Illuminate\Http\Request  $request
     */
    public function changeStatusOrder(Request $request, $id);

        /**
     * update details a order with admin and user ,
     * can admin change status order but user can't be doing this think
     * @param  \App\Orders  $id
     * @param  \Illuminate\Http\Request  $request
     */
    public function updateOrder(Request $request, $id);

    
    /**
     * show order for this clint in session
     */
    public function getClintOrders();

    /**
     * SoftDele a order
     * @param  \App\Orders  $id
     */
    public function softDeleteOrder($id);
}

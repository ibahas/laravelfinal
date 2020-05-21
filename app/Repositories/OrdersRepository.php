<?php

namespace App\Repositories;

use App\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrdersRepository implements OrdersInterface
{
    /**
     * Display  All Orders to applicant or Admin ...
     */
    public function getAllOrders()
    {
        //
        if (Auth::user()->role == 2) {
            $data = Orders::all();
            return response()->json(['status' => '200']);
            return response()->json($data);
        } else {
            return response()->json(['status' => '404']);
        }
    }

    /**
     * Display Order to applicant or Admin ...
     * @param  \App\Orders  $id
     */

    public function showOrderWithId($id)
    {
        //
        $order = Orders::find($id);
        if (Auth::guard('api')->user()->id == $order->user || Auth::guard('api')->user()->role == 1) {

            $data = Orders::find($id);
            return response()->json($data);
            return response()->json(['status' => '200']);
        } else {
            return response()->json(['status' => '404']);
        }
    }

    /**
     * Store a Order just to Users .
     * @param  \Illuminate\Http\Request  $request
     */
    public function storeNewOrder(Request $request)
    {
        //
        if (Auth::user()->role == 2) {
            $request->validate([
                'product' => 'required|exists:Products,id',
            ]);

            $data = [
                'product' => $request->product,
                'numbering' => $request->numbering,
                'user' => Auth::user()->id,
                'status' => '0',
            ];
            Orders::create($data);
            return response()->json(['status' => '200']);
        } else {
            return response()->json(['status' => '404']);
        }
    }

    /**
     * delete a order go to trashed .
     * @param  \App\Orders  $id
     */
    public function deleteOrder($id)
    {
        $order = Orders::find($id);
        if (Auth::user()->id == $order->id || Auth::user()->role == 1) {
            $order = Orders::find($id);
            $order->delete();
            return response()->json(['status' => '200']);
        } else {
            return response()->json(['status' => '404']);
        }
    }
    /**
     * SoftDele a order
     * @param  \App\Orders  $id
     */
    public function softDeleteOrder($id)
    {
        //
        $order = Orders::withTrashed()->find($id);
        // echo $order->user;
        if (Auth::guard('api')->user()->id == $order->user || Auth::guard('api')->user()->role == 1) {
            $findOrder = Orders::withTrashed()->find($id);

            if ($findOrder->deleted_at == null) {
                $order = Orders::find($id);
                $order->delete($id);
                return response()->json(['status' => '200']);
            } else {
                return response()->json(['status' => '404']);
            }
        } else {
            return response()->json(['status' => '404']);
        }
    }
    /**
     * Display All Trashed Orders .
     */
    public function getAllwithTrashed()
    {
        //
        if (Auth::user()->role == 1) {
            $data = Orders::onlyTrashed()->get();
            return response()->json($data);
        } else {
            return response()->json(['status' => '404']);
        }
    }

    /**
     * Restore Order
     * @param  \App\Orders  $id
     */

    public function restoreOrderWithId($id)
    {
        //
        if (Auth::guard('api')->user()->role == 1) {
            Orders::withTrashed()
                ->where('id', $id)
                ->restore();
                return response()->json(['status' => '200']);

        } else {
            return response()->json(['status' => '404']);
        }
    }

    /**
     * Force Delete  Order by admin or User
     * @param  \App\Orders  $id
     */
    public function forcDeleteOrderWithId($id)
    {
        //
        if (Auth::user()->role == 1) {
            $findOrder = Orders::withTrashed()->find($id);

            if ($findOrder->deleted_at == null) {
                return response()->json(['status' => '404']);
            } else {
                $product = Orders::withTrashed()->find($id);
                $product->forceDelete();
                return response()->json(['status' => '200']);
            }
        } else {
            return response()->json(['status' => '404']);
        }

    }

    /**
     * Change Status Order With admin.
     * @param  \App\Orders  $id
     * @param  \Illuminate\Http\Request  $request
     */
    public function changeStatusOrder(Request $request, $id)
    {
        //
        if (Auth::user()->role == 1) {
            $request->validate([
                'status' => 'required',
            ]);
            $data = [
                'status' => $request->status,
                'trustee' => Auth::user()->id,
            ];
            Orders::where('id', $id)->update($data);
            return response()->json(['status' => '200']);
        }
    }

    /**
     * update details a order with admin and user ,
     * can admin change status order but user can't be doing this think
     * @param  \App\Orders  $id
     * @param  \Illuminate\Http\Request  $request
     */
    public function updateOrder(Request $request, $id)
    {
        $order = Orders::find($id);
        // echo Auth::guard('api')->user()->id;
        if (Auth::guard('api')->user()->id == $order->user && $order->status == 0) {

            $request->validate([
                'product' => 'required|exists:Products,id',
                'numbering' => 'required',
            ]);
            $data = [
                'product' => $request->product,
                'numbering' => $request->numbering,
            ];
            Orders::where('id', $id)->update($data);
            return response()->json(['status' => '200']);
        } else {
            return response()->json(['status' => '404']);
        }
    }

    /**
     * show order for this clint in session
     */
    public function getClintOrders()
    {
        //
        $orders = Orders::where('user', Auth::user()->id)->get();

        return response()->json($orders, 200);
    }

}

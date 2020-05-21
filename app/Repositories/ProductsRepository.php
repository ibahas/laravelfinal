<?php

namespace App\Repositories;

use App\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductsRepository implements ProductsInterface
{

    /**
     * Display All Products where status published
     */
    public function getAllProducts()
    {
        //
        return Products::where('status', 1)->get();
    }

    /**
     * show details product by id to all
     * @param  \App\Products  $id
     */
    public function getProductByID($id)
    {
        //
        $data = Products::where('status', 1)->find($id);
        return response()->json($data);
    }

    /**
     * Display Products Admin in session .
     */
    public function showAllProductsUser()
    {
        //
        $userAuth = Auth::user()->id;
        $data = Products::where('user', $userAuth)->get();
        return response()->json($data);
    }

    /**
     * Store a new product by Admin .
     * @param  \Illuminate\Http\Request  $request
     */
    public function storeNewProduct(Request $request)
    {
        //
        if (Auth::user()->role == 1) {

            // $validated = request()->validate([
            // 'title' => 'required',
            // 'description' => 'required',
            // 'photo' => 'required',
            // 'status' => 'required',
            // 'user' => 'required',
            // ]);
            if ($request->hasFile('photo')) {
                $files = $request->file('photo');
                $destinationPath = public_path("/image/students/");
                $imgfile = time() . "." . $files->getClientOriginalExtension();
                $files->move($destinationPath, $imgfile);
            } else {
                $imgfile = null;
            }

            $data = [
                'title' => $request->title,
                'description' => $request->description,
                'photo' => $imgfile,
                'status' => $request->status,
                'user' => Auth::user()->id,
            ];
            Products::create($data);
            return response()->json(['status' => '200']);
        } else {
            return response()->json(['status' => '404']);
        }
    }

    /**
     * update a products
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Products  $id
     */
    public function updateProduct(Request $request, $id)
    {
        //
        
        $findProduct = Products::find($id);
        if (Auth::user()->role == 1 && $findProduct->user == Auth::user()->id) {
            if ($request->hasFile('photo')) {
                $files = $request->file('photo');
                $destinationPath = public_path("/image/students/");
                $imgfile = time() . "." . $files->getClientOriginalExtension();
                $files->move($destinationPath, $imgfile);
            } else {
                $imgfile = null;
            }

            $data = [
                'title' => $request->title,
                'description' => $request->description,
                'photo' => $imgfile,
                'status' => $request->status,
            ];
            Products::where('id',$id)->update($data);
            return response()->json(['status' => '200']);
        } else {
            return response()->json(['status' => '404']);
        }
    }

    /**
     * Request a product
     * @param  \Illuminate\Http\Request  $request
     */
    public function userAddRequestOfProduct(Request $request)
    {
        //
        if (Auth::user()->role == 2) {
            $data = [
                'title' => $request->title,
                'status' => 3,
                'description' => ' ',
                'photo' => ' ',
                'user' => Auth::user()->id,
            ];
            Products::create($data);
            return response()->json(['status' => '200']);
        } else {
            return response()->json(['status' => '404']);
        }
    }

    /**
     * softDelete a Product ...
     * @param  \App\Products  $id
     */
    public function softDeleteAProduct($id)
    {
        //
        if (Auth::user()->role == 1) {
            $findProduct = Products::withTrashed()->find($id);

            if ($findProduct->deleted_at == null) {
                $product = Products::find($id);
                $product->delete($id);
                return response()->json(['status' => '200']);
            } else {
                return response()->json(['status' => '404']);
            }
        } else {
            return response()->json(['status' => '404']);
        }

    }

    /**
     * get with Trashed Products ..
     */
    public function productsWithTrashed()
    {
        //
        if (Auth::user()->role == 1) {
            $products = Products::onlyTrashed()->get();
            return response()->json($products);
        } else {
            return response()->json(['status' => '404']);
        }
    }
    /**
     * forceDelete to Products
     * @param  \App\Products  $id
     */
    public function forceDeleteProduct($id)
    {

        if (Auth::user()->role == 1) {
            $findProduct = Products::withTrashed()->find($id);

            if ($findProduct->deleted_at == null) {
                return response()->json(['status' => '404']);
            } else {
                $product = Products::withTrashed()->find($id);
                $product->forceDelete();
                return response()->json(['status' => '200']);
            }
        } else {
            return response()->json(['status' => '404']);
        }

    }
    /**
     * restore to Products
     * @param  \App\Products  $id
     */
    public function restoreProduct($id)
    {
        //
        if (Auth::user()->role == 1) {
            $findProduct = Products::withTrashed()->find($id);
            if ($findProduct->deleted_at == null) {
                return response()->json(['status' => '404']);
            } else {
                Products::withTrashed()
                    ->where('id', $id)
                    ->restore();
                return response()->json(['status' => '200']);
            }
        } else {
            return response()->json(['status' => '404']);
        }

    }
    /**
     * get all products by clints
     */
    public function showproductbyclints(){
        $data = Products::where('status' , 3)->get();
        return response()->json($data, 200);
    }
}

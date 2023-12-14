<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\Movie;
use App\Models\Backend\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Backend\Category;
use App\Models\Backend\Genre;
use App\Models\Backend\Blog;
use App\Models\User;

class CartController extends Controller
{
    public function AddToCard(Request $request, $id){

        $movie = Product::findOrfail($id);

        $cartItem = Cart::search(function ($cartItem, $rowId) use ($id) {
            return $cartItem->id === $id;
        })->first();

        if ($cartItem) {
            return response()->json(['error' => 'Item is already in your cart']);
        }


        if($movie->discount_price == NULL){

            Cart::add([

                'id' => $id,
                'name' => $request->movie_name,
                'qty' => $request->quantity,
                'price' => $movie->selling_price,
                'weight' => 1,
                'options' => [
                    'image' => $movie->photo,
                ],
            ]);

            return response()->json(['success' => 'Successfully Added on your Cart']);

        }else{

            Cart::add([

                'id' => $id,
                'name' => $request->movie_name,
                'qty' => $request->quantity,
                'price' => $movie->discount_price,
                'weight' => 1,
                'options' => [
                    'image' => $movie->photo,
                ],
            ]);

            return response()->json(['success' => 'Successfully Added on your Cart']);

        }
    }// End Method

    public function AddToCartDetails(Request $request, $id){

        $movie = Product::findOrfail($id);

        $cartItem = Cart::search(function ($cartItem, $rowId) use ($id) {
            return $cartItem->id === $id;
        })->first();

        if ($cartItem) {
            return response()->json(['error' => 'Item is already in your cart']);
        }


        if($movie->discount_price == NULL){

            Cart::add([

                'id' => $id,
                'name' => $request->movie_name,
                'qty' => $request->quantity,
                'price' => $movie->selling_price,
                'weight' => 1,
                'options' => [
                    'image' => $movie->photo,
                ],
            ]);

            return response()->json(['success' => 'Successfully Added on your Cart']);

        }else{

            Cart::add([

                'id' => $id,
                'name' => $request->movie_name,
                'qty' => $request->quantity,
                'price' => $movie->discount_price,
                'weight' => 1,
                'options' => [
                    'image' => $movie->photo,
                ],
            ]);

            return response()->json(['success' => 'Successfully Added on your Cart']);

        }
    }// End Method

    public function AddMiniCart(){
        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();

        return response()->json(array(
            'carts' => $carts,
            'cartQty' => $cartQty,
            'cartTotal' => $cartTotal

        ));
    }// End Method

    public function RemoveMiniCart($rowId){
        Cart::remove($rowId);
        return response()->json(['success' => 'Item Remove From Cart']);

    }// End Method

    public function MyCart(){
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('frontend.mycart.view_mycart',compact('user'));
    }// End Method

    public function GetCartProduct(){

        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();

        return response()->json(array(
            'carts' => $carts,
            'cartQty' => $cartQty,
            'cartTotal' => $cartTotal

        ));

    }// End Method

    public function CartRemove($rowId){
        Cart::remove($rowId);
        return response()->json(['success' => 'Successfully Remove From Cart']);

    }// End Method


    public function CheckoutCreate(){

        if (Auth::check()) {
            if (Cart::total() > 0) { 
                $carts = Cart::content();
                $cartQty = Cart::count();
                $cartTotal = Cart::total();

                $id = Auth::user()->id;
                $user = User::find($id);

                return view('frontend.checkout.checkout_view',compact('carts','cartQty','cartTotal','user'));
            }else{
                $notification = array(
                    'message' => 'Shopping At list One Product',
                    'alert-type' => 'error'
                );

                return redirect()->to('/')->with($notification);
            }
        }else{
            $notification = array(
                'message' => 'You Need to Login First',
                'alert-type' => 'error'
            );

            return redirect()->route('login')->with($notification);
        }

    }// End Method


}

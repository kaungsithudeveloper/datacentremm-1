<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Backend\Category;
use App\Models\Backend\Genre;
use App\Models\Backend\Blog;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;

class WishListController extends Controller
{
    public function AddToWishList(Request $request, $movie_id)
    {
        if (Auth::check()) {
            $exists = Wishlist::where('user_id', Auth::id())->where('product_id', $movie_id)->first();

            if (!$exists) {
                Wishlist::insert([
                    'user_id' => Auth::id(),
                    'product_id' => $movie_id,
                    'created_at' => Carbon::now(),
                ]);
                return response()->json(['success' => 'Successfully Added On Your Wishlist' ]);
            } else {
                return response()->json(['error' => 'Item Has Already on Your Wishlist' ]);
            }
        } else {
            return response()->json(['error' => 'At First Login Your Account' ]);
        }
    }// End Method

    public function AllWishlist(){

        $id = Auth::user()->id;
        $user = User::find($id);
        $orders = Order::where('user_id',$id)->orderBy('id','DESC')->paginate(6);
        $ordersCount = $orders->count();
        $wishlist = Wishlist::with(['product.categories'])->where('user_id', Auth::id())->latest()->get();
        $wishQty = $wishlist->count();
        $genres = Genre::all();
        $posts = Blog::latest()->take(6)->get();
        return view('frontend.wishlist.view_wishlist',compact('user','genres','posts','ordersCount','wishQty'));

    }// End Method

    public function GetWishlistMovie(){

        $wishlist = Wishlist::with(['product.categories'])->where('user_id', Auth::id())->latest()->get();
        $wishQty = $wishlist->count();

        return response()->json(['wishlist'=> $wishlist, 'wishQty' => $wishQty]);

    }// End Method

    public function WishlistRemove($id){

        Wishlist::where('user_id',Auth::id())->where('id',$id)->delete();
     return response()->json(['success' => 'Successfully Product Remove' ]);
    }// End Method
}

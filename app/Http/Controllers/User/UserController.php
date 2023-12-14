<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Image;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Backend\Product;
use App\Models\Wishlist;

class UserController extends Controller
{

    public function UserAccount(){

        $id = Auth::user()->id;
        $user = User::find($id);
        $orders = Order::where('user_id',$id)->orderBy('id','DESC')->paginate(6);
        $ordersCount = $orders->count();
        $wishlist = Wishlist::with(['product.categories'])->where('user_id', Auth::id())->latest()->get();
        $wishQty = $wishlist->count();
        return view('frontend.users.user_account',compact('user','ordersCount','wishQty'));

    } // End Method

    public function UserProfileUpdate(Request $request)
    {

        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;


        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/user_images/'.$data->photo));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/user_images'),$filename);
            $data['photo'] = $filename;
        }

        $data->save();

        $notification = array(
            'message' => 'User Profile Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    } // End Mehtod

    public function UserPassword()
    {

        $id = Auth::user()->id;
        $user = User::find($id);
        $orders = Order::where('user_id',$id)->orderBy('id','DESC')->paginate(6);
        $ordersCount = $orders->count();
        $wishlist = Wishlist::with(['product.categories'])->where('user_id', Auth::id())->latest()->get();
        $wishQty = $wishlist->count();
        return view('frontend.users.user_password',compact('user', 'ordersCount','wishQty'));

    } // End Method

    public function UserUpdatePassword(Request $request)
    {
        // Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Match The Old Password
        if (!Hash::check($request->old_password, Auth::user()->password)) {
            return back()->with("error", "Old Password Doesn't Match!!");
        }

        // Update The new password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)

        ]);
        return back()->with("status", " Password Changed Successfully");

    } // End Mehtod

    public function UserOrder(){
        $id = Auth::user()->id;
        $user = User::find($id);
        $orders = Order::where('user_id',$id)->orderBy('id','DESC')->paginate(6);
        $ordersCount = $orders->count();
        $wishlist = Wishlist::with(['product.categories'])->where('user_id', Auth::id())->latest()->get();
        $wishQty = $wishlist->count();
        return view('frontend.users.user_order',compact('orders', 'ordersCount','user','wishQty'));
    }// End Method

    public function UserOrderDetails($order_id){
        $id = Auth::user()->id;
        $user = User::find($id);
        $wishlist = Wishlist::with(['product.categories'])->where('user_id', Auth::id())->latest()->get();
        $wishQty = $wishlist->count();
        $order = Order::with('user')->where('id',$order_id)->where('user_id',Auth::id())->first();
        $orderItem = OrderItem::with('product')->where('order_id',$order_id)->orderBy('id','DESC')->get();
        $ordersCount = $order->count();

        return view('frontend.users.order_details',compact('order','orderItem','ordersCount','wishQty','user'));

    }// End Method

    public function UserLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}

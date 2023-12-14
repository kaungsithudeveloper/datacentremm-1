<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Backend\Product;
use App\Models\Backend\Category;
use App\Models\Backend\Genre;
use App\Models\Backend\Cast;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Image;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;

class OrderController extends Controller
{
    public function Orders(){
        $orders = Order::orderBy('id','DESC')->get();
        return view('backend.orders.orders',compact('orders'));
    } // End Method

    public function OrdersPending(){
        $orders = Order::where('status','pending')->orderBy('id','DESC')->get();
        return view('backend.orders.pending_orders',compact('orders'));
    } // End Method

    public function OrdersComplete(){
        $orders = Order::where('status','complete')->orderBy('id','DESC')->get();
        return view('backend.orders.complete_orders',compact('orders'));
    } // End Method

    public function AdminOrderDetails($order_id){

        $order = Order::with('user')->where('id',$order_id)->first();
        $orderItem = OrderItem::with('product')->where('order_id',$order_id)->orderBy('id','DESC')->get();

        return view('backend.orders.admin_order_details',compact('order','orderItem'));

    }// End Method

    public function OrderComplete($id)
    {

        Order::findOrFail($id)->update(['status' => 'complete']);
        $notification = array(
            'message' => 'Order Complete',
            'alert-type' => 'success'
        );

        return redirect()->route('orders')->with($notification);

    }// End Method

    public function OrderPending($id)
    {

        Order::findOrFail($id)->update(['status' => 'pending']);
        $notification = array(
            'message' => 'Order Complete',
            'alert-type' => 'success'
        );

        return redirect()->route('orders')->with($notification);

    }// End Method

    public function OrderDelete($id)
    {

        $order = Order::findOrFail($id);
        if (!is_null($order)) {
            $order->delete();
        }

         $notification = array(
            'message' => 'Order Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }// End Mehtod


}

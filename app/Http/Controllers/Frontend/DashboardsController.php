<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Payment;
use App\Models\Order;
use App\Models\OrderDetail;
use Session;
use Cart;
use PDF;

class DashboardsController extends Controller
{
    
    public function dashboard()
    {
        $user = Auth::user();
        return view('frontend.pages.dashboards.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function changePassword()
    {
        return view('frontend.pages.dashboards.edit_password');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request)
    {
        if(Auth::attempt(['id' => Auth::user()->id, 'password' => $request->current_password]))
        {
            $user = User::find(Auth::user()->id);
            $user->password = bcrypt($request->new_password);
            $user->save();
            return redirect()->route('customer.dashboard')->with('success', 'Your Password Change Successfully');
        }else{
            return redirect()->back()->with('warning', 'Your Current Password Does Not Match');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function payment()
    {
        return view('frontend.pages.checkouts.customer_payment');
    }
    /*
     * payment Store Method
     */
    public function paymentStore(Request $request)
    {
        if($request->product_id == NULL)
        {
            return redirect()->back()->with('warning', 'Please Select Any Product');
        }else{
            $this->validate($request, [
                'payment_method' => 'required',
            ]);
            
            if($request->payment_method == 'bkash' && $request->transaction_no == NULL)
            {
                return redirect()->back()->with('message', 'Please Enter Transaction No');
            }
            
            $payments = new Payment();
            $payments->payment_method = $request->payment_method;
            $payments->transaction_no = $request->transaction_no;
            $payments->save();
            
            $orders = new Order();
            $orders->user_id = Auth::user()->id;
            $orders->shipping_id = Session::get('shipping_id');
            $orders->payment_id = $payments->id;
            $order_data = Order::orderBy('id', 'desc')->first();
            if($order_data == NULL)
            {
                $firstReg = 0;
                $order_no = $order_data + 1;
            }else{
                $order_data = Order::orderBy('id', 'desc')->first()->order_no;
                $order_no = $order_data + 1;
            }
            $orders->order_no = $order_no;
            $orders->order_total = $request->order_total;
            $orders->status = 0;
            $orders->save();
            
            $contents = Cart::content();
            foreach ($contents as $content) {
                $order_details = new OrderDetail();
                $order_details->order_id = $orders->id;
                $order_details->product_id = $content->id;
                $order_details->color_id = $content->options->color_id;
                $order_details->size_id = $content->options->size_id;            
                $order_details->quantity = $content->qty;            
                $order_details->save(); 
            }
            Cart::destroy();
            return redirect()->route('customer.order.list')->with('success', 'Your Order Taken Successfully');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = User::find(Auth::user()->id);
        return view('frontend.pages.dashboards.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = User::find(Auth::user()->id);
        
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'mobile' => ['required', 'unique:users,mobile,'.$user->id, 'regex:/(^(\+8801|8801|01|008801))[1|5-9]{1}(\d){8}$/'],
            'address' => 'required',
            'gender' => 'required',
            'image' => 'image|mimes:jpg,jpeg,png,gif|max:3000',
        ]);
        
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->address = $request->address;
        $user->gender = $request->gender;
        $img = $request->file('image');
        if($img)
        {
            $imgName = date('YmdHi').$img->getClientOriginalName();
            $img->move('images/users/', $imgName);
            if(file_exists('images/users/'.$user->image) AND !empty($user->image))
            {
                unlink('images/users/'.$user->image);
            }
            $user['image'] = $imgName;
        }
        $user->save();
        return redirect()->route('customer.dashboard')->with('success', 'Profile data Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function orderList()
    {
        $orders = Order::where('user_id', Auth::user()->id)->get();
        return view('frontend.pages.dashboards.customer_order', compact('orders'));
    }
    
    /*
     * Customer Order Details Method
     */
    public function orderDetails($id)
    {
        $orderData = Order::find($id);
        $orders = Order::where('id', $orderData->id)->where('user_id', Auth::user()->id)->first();
        if($orders == false)
        {
            return redirect()->back()->with('warning', 'do not try to be over snart');
        }else{
            $orders = Order::with('order_details')->where('id', $orderData->id)->where('user_id', Auth::user()->id)->first();
            return view('frontend.pages.dashboards.order_details', compact('orders'));
        }
        
    }
    
    /*
     * Customer Order Print Method
     */
    public function orderPrint($id)
    {
        $orderData = Order::find($id);
        $orders = Order::where('id', $orderData->id)->where('user_id', Auth::user()->id)->first();
        if($orders == false)
        {
            return redirect()->back()->with('warning', 'do not try to be over snart');
        }else{
            $orders = Order::with('order_details')->where('id', $orderData->id)->where('user_id', Auth::user()->id)->first();
            $pdf = PDF::loadView('frontend.pages.dashboards.order_print', compact('orders'));
            //$pdf->SetProtection(['copy', 'print'], '', 'pass');
            return $pdf->stream('document.pdf');
        }
    }
}

<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Shipping;
use App\Models\User;
use Session;
use Mail;

class CheckoutsController extends Controller
{
    
    public function index()
    {
        return view('frontend.pages.customers.customer_login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function signup()
    {
        return view('frontend.pages.customers.customer_signup');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'min:8|required_with:confirm_password|same:confirm_password',
            'mobile' => ['required', 'unique:users,mobile', 'regex:/(^(\+8801|8801|01|008801))[1|5-9]{1}(\d){8}$/'],
            'confirm_password' => 'min:8',
        ]);
        
        $code = rand(0000,9999);
        $user = new User();
        $user->name = $request->name;
        $user->usertype = 'customer';
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->mobile = $request->mobile;
        $user->code = $code;
        $user->status = 0;
        $user->save();
        
        $data = array(
            'email' => $request->email,
            'code' => $code,
        );
        
        Mail::send('frontend.pages.emails.verify_email',$data,function($message) use($data){
            $message->from('montashirb@gmail.com', 'FurnishFurniture');
            $message->to($data['email']);
            $message->subject('Please Verify Your Rmail Address');
        });
        
        return redirect()->route('email.verify')->with('success', 'Successfully Signup, Please verify Email');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function emailVerify()
    {
        return view('frontend.pages.customers.email_verify');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function verifyStore(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'code' => 'required',
        ]);
        
        $userverify = User::where('email', $request->email)->where('code', $request->code)->first();
        if(!is_null($userverify))
        {
            $userverify->status = 1;
            $userverify->save();
            return redirect()->route('customer.login')->with('success', 'You Have Successfully Verifyed');
        }else{
            return redirect()->back()->with('warning', 'Email or Code is Invalid');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function checkOut()
    {
        return view('frontend.pages.checkouts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function checkStore(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'mobile' => ['required', 'regex:/(^(\+8801|8801|01|008801))[1|5-9]{1}(\d){8}$/'],
            'address' => 'required',
        ]);
        
        $checkouts = new Shipping();
        $checkouts->user_id = Auth::user()->id;
        $checkouts->name = $request->name;
        $checkouts->email = $request->email;
        $checkouts->mobile = $request->mobile;
        $checkouts->address = $request->address;
        $checkouts->save();
        Session::put('shipping_id', $checkouts->id);
        return redirect()->route('customer.payment')->with('success', 'Shipping Data Saved Successfully');
    }
}

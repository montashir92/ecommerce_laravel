<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        $email = $request->email;
        $password = $request->password;
        
        $validData = User::where('email', $email)->first();
        
        $check_password = password_verify($request->password, $validData->password);
        
        if($check_password == false)
        {
            return redirect()->back()->with('toast_error', 'Email or Password Does Not Match');
        }
        
        if($validData->status == 0)
        {
            return redirect()->back()->with('warning', 'You Are Not Verifyed Yet');
        }
        
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password]))
        {
            return redirect()->route('login');
        }
    }
}

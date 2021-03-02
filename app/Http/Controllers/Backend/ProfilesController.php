<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ProfilesController extends Controller
{
    
    public function index()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('backend.pages.profles.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function changePassword()
    {
        return view('backend.pages.profles.edit_password');
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
            return redirect()->route('user.profiles')->with('toast_success', 'Your Password Change Successfully');
        }else{
            return redirect()->back()->with('toast_error', 'Your Current Password Does Not Match');
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
        $id = Auth::user()->id;
        $userdata = User::find($id);
        return view('backend.pages.profles.edit', compact('userdata'));
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
        $this->validate($request, [
            'name' => 'required',
            'email' => 'email',
            'mobile' => 'required|numeric',
            'address' => 'required',
            'gender' => 'required',
            'image' => 'image|mimes:jpg,jpeg,png,gif|max:3000',
        ]);
        
        $users = User::find(Auth::user()->id);
        $users->name = $request->name;
        $users->email = $request->email;
        $users->mobile = $request->mobile;
        $users->address = $request->address;
        $users->gender = $request->gender;
        
        
        if($request->file('image'))
        {
            $file = $request->file('image');
            @unlink('images/users/'.$users->image);
            $fileName = date('YmdHi').$file->getClientOriginalName();
            $file->move('images/users/', $fileName);
            $users['image'] = $fileName;
        }
        $users->save();
        return redirect()->route('user.profiles')->with('toast_success', 'Your Profle Data Updated Successfully');
    }

}

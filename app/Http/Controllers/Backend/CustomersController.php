<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class CustomersController extends Controller
{
    
    public function index()
    {
        $customerdata = User::where('usertype', 'customer')->where('status', 1)->get();
        return view('backend.pages.customer.index', compact('customerdata'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function draftShow()
    {
        $customerdraft = User::where('usertype', 'customer')->where('status', 0)->get();
        return view('backend.pages.customer.graft_show', compact('customerdraft'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $cusromer = User::find($request->id);
        if(!is_null($cusromer))
        {
            if(file_exists('images/users/'.$cusromer->image) AND !empty($cusromer->image));
            {
                unlink('images/users/'.$cusromer->image);
            }
            
            $cusromer->delete();
        }
        
        return redirect()->back()->with('toast_success', 'Customer Data Deleted Successfully');
    }
}

<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;

class SlidersController extends Controller
{
    
    public function index()
    {
        $sliders = Slider::all();
        return view('backend.pages.sliders.index', compact('sliders'));
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
            'short_title' => 'required',
            'long_title' => 'required',
            'image' => 'required|image|mimes:jpg,jpeg,png,gif|max:3000',
        ]);
        
        $sliders = new Slider();
        $sliders->short_title = $request->short_title;
        $sliders->long_title = $request->long_title;
        
        $img = $request->file('image');
        if($img)
        {
            $imgName = date('YmdHi').$img->getClientOriginalName();
            $img->move('images/sliders/', $imgName);
            $sliders['image'] = $imgName;
        }
        $sliders->save();
        return redirect()->route('admin.sliders')->with('toast_success', 'A New Slider Added Successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'short_title' => 'required',
            'long_title' => 'required',
            'image' => 'image|mimes:jpg,jpeg,png,gif|max:3000',
        ]);
        
        $slider = Slider::find($id);
        $slider->short_title = $request->short_title;
        $slider->long_title = $request->long_title;
        
        $img = $request->file('image');
        if($img)
        {
            $imgName = date('YmdHi').$img->getClientOriginalName();
            @unlink('images/sliders/'.$slider->image);
            $img->move('images/sliders/', $imgName);
            $slider['image'] = $imgName;
        }
        $slider->save();
        return redirect()->route('admin.sliders')->with('toast_success', 'Slider Data Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $slider = Slider::find($request->id);
        if(!is_null($slider))
        {
            if(file_exists('images/sliders/'.$slider->image) AND !empty($slider->image))
            {
                unlink('images/sliders/'.$slider->image);
            }
            $slider->delete();
        }
        return redirect()->back()->with('toast_success', 'Slider Data Deleted Successfully');
    }
}

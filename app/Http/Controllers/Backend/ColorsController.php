<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Color;

class ColorsController extends Controller
{
    
    public function index()
    {
        $colors = Color::all();
        return view('backend.pages.colors.index', compact('colors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.colors.create');
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
            'name' => 'required|unique:colors,name',
        ]);
        
        $colors = new Color();
        $colors->name = $request->name;
        $colors->save();
        return redirect()->route('admin.color.create')->with('toast_success', 'A New Color Added Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $color = Color::find($id);
        return view('backend.pages.colors.edit', compact('color'));
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
            'name' => 'required',
        ]);
        
        $colors = Color::find($id);
        $colors->name = $request->name;
        $colors->save();
        return redirect()->route('admin.colors')->with('toast_success', 'Color Data Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $color = Color::find($request->id);
        if(!is_null($color))
        {
            $color->delete();
        }
        
        return redirect()->back()->with('toast_success', 'Color Data Deleted Successfully');
    }
}

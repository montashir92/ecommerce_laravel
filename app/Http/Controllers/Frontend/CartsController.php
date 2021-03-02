<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Size;
use App\Models\Color;
use Cart;

class CartsController extends Controller
{
    
    public function index()
    {
        return view('frontend.pages.carts.index');
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
            'size_id' => 'required',
            'color_id' => 'required',
        ]);
        
        $product = Product::where('id', $request->id)->first();
        $product_size = Size::where('id', $request->size_id)->first();
        $product_color = Color::where('id', $request->color_id)->first();
        
        Cart::add([
            'id' => $product->id, 
            'name' => $product->name, 
            'qty' => $request->qty, 
            'price' => $product->price, 
            'weight' => 550, 
            'options' => [
                'size_id' => $request->size_id,
                'size_name' => $product_size->name,
                'color_id' => $request->color_id,
                'color_name' => $product_color->name,
                'image' => $product->image,
                ],
            ]);
        
        return redirect()->route('carts')->with('success', 'Items Added To Cart');
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
        Cart::update($request->rowId, $request->qty);
        return redirect()->back()->with('success', 'Cart Data Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($rowId)
    {
        Cart::remove($rowId);
        return redirect()->back()->with('success', 'Cart Data Deleted Successfully');
    }
}

<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductColor;
use App\Models\ProductSize;

class ProductController extends Controller
{
    
    public function index()
    {
        $products = Product::orderBy('id', 'desc')->paginate(12);
        $categories = Product::select('category_id')->groupBy('category_id')->get();
        $brands = Product::select('brand_id')->groupBy('brand_id')->get();
        return view('frontend.pages.products.index', compact('products', 'categories', 'brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function categoryProduct($category_id)
    {
        $products = Product::orderBy('id', 'desc')->where('category_id', $category_id)->get();
        $categories = Product::select('category_id')->groupBy('category_id')->get();
        $brands = Product::select('brand_id')->groupBy('brand_id')->get();
        return view('frontend.pages.products.category_product', compact('products', 'categories', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function brandProduct($brand_id)
    {
        $products = Product::orderBy('id', 'desc')->where('brand_id', $brand_id)->get();
        $categories = Product::select('category_id')->groupBy('category_id')->get();
        $brands = Product::select('brand_id')->groupBy('brand_id')->get();
        return view('frontend.pages.products.brand_product', compact('products', 'categories', 'brands'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->first();
        $sub_image = ProductImage::where('product_id', $product->id)->get();
        $product_color = ProductColor::where('product_id', $product->id)->get();
        $product_size = ProductSize::where('product_id', $product->id)->get();
        return view('frontend.pages.products.show', compact('product', 'sub_image', 'product_color', 'product_size'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $slug = $request->search;
        $product = Product::where('slug', $slug)->first();
        if($product)
        {
            $product = Product::where('slug', $slug)->first();
            $sub_image = ProductImage::where('product_id', $product->id)->get();
            $product_color = ProductColor::where('product_id', $product->id)->get();
            $product_size = ProductSize::where('product_id', $product->id)->get();
            return view('frontend.pages.products.product_search', compact('product', 'sub_image', 'product_color', 'product_size'));
        }else{
            return redirect()->back()->with('warning', 'Product Does Not Match');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function productGet(Request $request)
    {
        $slug = $request->slug;
        $product = Product::where('slug', 'LIKE', '%'.$slug.'%')->get();
        
        $html = '';
        $html .= '<div><ul>';
        if($product)
        {
            foreach ($product as $v) {
               $html .= '<li>'.$v->slug.'</li>'; 
            }
        }
        $html .= '</ul></div>';
        return response()->json($html);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

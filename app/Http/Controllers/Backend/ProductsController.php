<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductColor;
use App\Models\ProductSize;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Size;

class ProductsController extends Controller
{
    
    public function index()
    {
        $products = Product::all();
        return view('backend.pages.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['categories'] = Category::all();
        $data['brands'] = Brand::all();
        $data['colors'] = Color::all();
        $data['sizes'] = Size::all();
        return view('backend.pages.products.create', $data);
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
            'name' => 'required|unique:products,name',
            'short_desc' => 'required',
            'long_desc' => 'required',
            'color_id' => 'required',
            'size_id' => 'required',
        ]);
        
        $products = new Product();
        $products->category_id = $request->category_id;
        $products->brand_id = $request->brand_id;
        $products->name = $request->name;
        $products->slug = Str::slug($request->name);
        $products->short_desc = $request->short_desc;
        $products->long_desc = $request->long_desc;
        $products->price = $request->price;
        
        $img = $request->file('image');
        if($img)
        {
            $imgName = date('YmdHi').$img->getClientOriginalName();
            $img->move('images/products/', $imgName);
            $products['image'] = $imgName;
        }
        $products->save();
        
        //Sub Image Table data Insered
        $files = $request->sub_image;
        if(!empty($files))
        {
            foreach ($files as $file) {
                $imgName = date('YmdHi').$file->getClientOriginalName();
                $file->move('images/sub_products/', $imgName);
                $subimage['sub_image'] = $imgName;
                
                $subimage = new ProductImage();
                $subimage->product_id = $products->id;
                $subimage->sub_image = $imgName;
                $subimage->save();
            }
        }
        
        //color table Data Inserted
        $colors = $request->color_id;
        if(!is_null($colors))
        {
            foreach ($colors as $color) {
                $mycolor = new ProductColor();
                $mycolor->product_id = $products->id;
                $mycolor->color_id = $color;
                $mycolor->save();
            }
        }
        
        //size table Data Inserted
        $sizes = $request->size_id;
        if(!is_null($sizes))
        {
            foreach ($sizes as $size) {
                $mysize = new ProductSize();
                $mysize->product_id = $products->id;
                $mysize->size_id = $size;
                $mysize->save();
            }
        }
        
        return redirect()->route('admin.product.create')->with('toast_success', 'A New Product Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['product'] = Product::find($id);
        return view('backend.pages.products.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['product'] = Product::find($id);
        $data['categories'] = Category::all();
        $data['brands'] = Brand::all();
        $data['colors'] = Color::all();
        $data['sizes'] = Size::all();
        $data['color_array'] = ProductColor::select('color_id')->where('product_id', $data['product']->id)->orderBy('id', 'desc')->get()->toArray();
        $data['size_array'] = ProductSize::select('size_id')->where('product_id', $data['product']->id)->orderBy('id', 'desc')->get()->toArray();
        return view('backend.pages.products.edit', $data);
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
        $products = Product::find($id);
        
        $this->validate($request, [
            'name' => 'required|unique:products,name,'.$products->id,
            'short_desc' => 'required',
            'long_desc' => 'required',
            'color_id' => 'required',
            'size_id' => 'required',
        ]);
        
        $products->category_id = $request->category_id;
        $products->brand_id = $request->brand_id;
        $products->name = $request->name;
        $products->slug = Str::slug($request->name);
        $products->short_desc = $request->short_desc;
        $products->long_desc = $request->long_desc;
        $products->price = $request->price;
        
        $img = $request->file('image');
        if($img)
        {
            $imgName = date('YmdHi').$img->getClientOriginalName();
            $img->move('images/products/', $imgName);
            if(file_exists('images/products/'.$products->image) AND !empty($products->image))
            {
                unlink('images/products/'.$products->image);
            }
            $products['image'] = $imgName;
        }
        $products->save();
        
        //Sub Image Table data Insered
        $files = $request->sub_image;
        if(!empty($files))
        {
            $subImage = ProductImage::where('product_id', $id)->get()->toArray();
            foreach ($subImage as $value) {
                if(!empty($value))
                {
                    unlink('images/sub_products/'.$value['sub_image']);
                }
            }
            
            ProductImage::where('product_id', $id)->delete();
        }
        if(!empty($files))
        {
            foreach ($files as $file) {
                $imgName = date('YmdHi').$file->getClientOriginalName();
                $file->move('images/sub_products/', $imgName);
                $subimage['sub_image'] = $imgName;
                
                $subimage = new ProductImage();
                $subimage->product_id = $products->id;
                $subimage->sub_image = $imgName;
                $subimage->save();
            }
        }
        
        //color table Data Inserted
        $colors = $request->color_id;
        if(!is_null($colors))
        {
            ProductColor::where('product_id', $id)->delete();
        }
        if(!is_null($colors))
        {
            foreach ($colors as $color) {
                $mycolor = new ProductColor();
                $mycolor->product_id = $products->id;
                $mycolor->color_id = $color;
                $mycolor->save();
            }
        }
        
        //size table Data Inserted
        $sizes = $request->size_id;
        if(!is_null($sizes))
        {
            ProductSize::where('product_id', $id)->delete();
        }
        if(!is_null($sizes))
        {
            foreach ($sizes as $size) {
                $mysize = new ProductSize();
                $mysize->product_id = $products->id;
                $mysize->size_id = $size;
                $mysize->save();
            }
        }
        
        return redirect()->route('admin.products')->with('toast_success', 'Product Data Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $product = Product::find($request->id);
        if(!is_null($product))
        {
            if(file_exists('images/products/'.$product->image) AND !empty($product->image))
            {
                unlink('images/products/'.$product->image);
            }
            
            
            $subImage = ProductImage::where('product_id', $product->id)->get()->toArray();
            if(!is_null($subImage))
            {
                foreach ($subImage as $value) {
                    if(!empty($value))
                    {
                        unlink('images/sub_products'.$value['sub_image']);
                    }
                }
            }
            
            ProductImage::where('product_id', $product->id)->delete();
            ProductColor::where('product_id', $product->id)->delete();
            ProductSize::where('product_id', $product->id)->delete();
            $product->delete();
        }
        
        return redirect()->back()->with('toast_success', 'Product Data Deleted Successfully');
    }
}

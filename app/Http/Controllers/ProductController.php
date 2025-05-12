<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modesl\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $products = Product::all();
       
        // Return a different response format based on the route type
        if ($request->is('api/*')) {
             return response()->json([
                        'status' => true,
                        'result'=>$products
                    ], 200);
        }else{

            return view('product.list',['products'=>$products]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
     
        // Return a different response format based on the route type
        if ($request->is('api/*')) {
             return response()->json(['status' => true,'message'=>'Add new product!' ], 200);
        } else {
               return view('product.add');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug'=>'required|string|unique:products,slug',
            'short_description'=>'nullable|string|max:500',
            'description'=>'required', 
            'regular_price'=>'required|numeric|min:0', 
            'sale_price' =>'required|numeric|min:0',
            'quantity' =>'required|numeric|min:0',
            'image'=>'required|mimes:jpeg,jpg,png'
        ],[
            
            'name.required' => 'The product name is required.',
            'name.string' => 'The product name must be a valid string.',
            'name.max' => 'The product name may not be greater than 255 characters.',

            'slug.required' => 'The slug is required.',
            'slug.string' => 'The slug must be a string.',
            'slug.unique' => 'This slug is already in use. Please choose another.',

            'short_description.string' => 'The short description must be a valid string.',
            'short_description.max' => 'The short description cannot exceed 500 characters.',

            'description.required' => 'A full product description is required.',

            'regular_price.required' => 'The regular price is required.',
            'regular_price.numeric' => 'The regular price must be a number.',
            'regular_price.min' => 'The regular price must be at least 0.',

            'sale_price.required' => 'The sale price is required.',
            'sale_price.numeric' => 'The sale price must be a number.',
            'sale_price.min' => 'The sale price must be at least 0.',

            'quantity.required' => 'The quantity is required.',
            'quantity.numeric' => 'The quantity must be a number.',
            'quantity.min' => 'The quantity must be at least 0.',

            'image.required' => 'A product image is required.',
            'image.mimes' => 'The image must be a file of type: jpeg, jpg, png.',
        ]);

        $product = Product::create($validated);
        // Return a different response format based on the route type
        if ($request->is('api/*')) {
           return response()->json(['status' => true,'message'=>'Add Product added Sucesfully!' ], 201);
        } else {
            return redirect()->back()->with('meesage','Add Product added Sucesfully!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request,string $id)
    {
        $product = Product::findOrFail($id);
        // Return a different response format based on the route type
        if ($request->is('api/*')) {
           return response()->json(['status' => true,'result'=>$product ], 200);
        } else {
            return view('product.show',['product'=>$product]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request,string $id)
    {
        $product = Product::findOrFail($id);
        return view('product.edit',['product'=>$product]);
        // Return a different response format based on the route type
        if ($request->is('api/*')) {
            return response()->json(['status' => true,'result'=>$product ], 200);
        } else {
            return view('product.edit', ['product'=>$product]);
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug'=>'required|string|unique:products,slug,'.$id,
            'short_description'=>'nullable|string|max:500',
            'description'=>'required', 
            'regular_price'=>'required|numeric|min:0', 
            'sale_price' =>'required|numeric|min:0',
            'quantity' =>'required|numeric|min:0',
            'image'=>'nullable|mimes:jpeg,jpg,png'
        ],[
            
            'name.required' => 'The product name is required.',
            'name.string' => 'The product name must be a valid string.',
            'name.max' => 'The product name may not be greater than 255 characters.',

            'slug.required' => 'The slug is required.',
            'slug.string' => 'The slug must be a string.',
            'slug.unique' => 'This slug is already in use. Please choose another.',

            'short_description.string' => 'The short description must be a valid string.',
            'short_description.max' => 'The short description cannot exceed 500 characters.',

            'description.required' => 'A full product description is required.',

            'regular_price.required' => 'The regular price is required.',
            'regular_price.numeric' => 'The regular price must be a number.',
            'regular_price.min' => 'The regular price must be at least 0.',

            'sale_price.required' => 'The sale price is required.',
            'sale_price.numeric' => 'The sale price must be a number.',
            'sale_price.min' => 'The sale price must be at least 0.',
            'quantity.required' => 'The quantity is required.',
            'quantity.numeric' => 'The quantity must be a number.',
            'quantity.min' => 'The quantity must be at least 0.',
            'image.mimes' => 'The image must be a file of type: jpeg, jpg, png.',
        ]);


        $product = Product::findOrFail($id);
        $product->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'regular_price' => $request->regular_price,
            'sale_price' => $request->sale_price,
            'quantity' => $request->quantity,
            // If an image is provided, you can handle the image upload here
            'image' => $request->hasFile('image') ? $request->file('image')->store('products') : $product->image,
        ]);

        return response()->json($product);
        // Return a different response format based on the route type
        if ($request->is('api/*')) {
            // API response, typically JSON
            return response()->json($data, 200);
        } else {
            // Web response, typically a view or custom response
            return response()->view('welcome', $data);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json(['message' => 'Product deleted successfully']);
        // Return a different response format based on the route type
        if ($request->is('api/*')) {
            // API response, typically JSON
            return response()->json($data, 200);
        } else {
            // Web response, typically a view or custom response
            return response()->view('welcome', $data);
        }
    }
}

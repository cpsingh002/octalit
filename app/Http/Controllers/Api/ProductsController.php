<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $products = Product::all();  
            return response()->json([
                'status' => true,
                'message' => 'Products retrieved successfully',
                'data' => $products
            ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return response()->json(['status' => true,'message'=>'Add new product!'], 200);   
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
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


        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }
        $product = Product::create($validator);
        return response()->json(['status' => true,'message' => 'Product created successfully', 'result'=>$product], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request,string $id)
    {
        $product = Product::findOrFail($id);
        return response()->json(['status' => true,'message' => 'Product found successfully','result'=>$product ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request,string $id)
    {
        $product = Product::findOrFail($id);    
        return response()->json(['status' => true,'message' => 'Product found successfully','result'=>$product ], 200);
       

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
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

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $product = Product::findOrFail($id);
        $product->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'regular_price' => $request->regular_price,
            'sale_price' => $request->sale_price,
            'quantity' => $request->quantity,
            'image' => $request->hasFile('image') ? $request->file('image')->store('products') : $product->image,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Product updated successfully',
            'result' => $product
        ], 200);
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json([
            'status' => true,
            'message' => 'Product deleted successfully'
        ], 204);
    }
}

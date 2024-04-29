<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use App\Models\Product;


class ProductController extends Controller
{
    // This method will show product page
    public function index(){
        $products = Product::all(); // Retrieve all products from the database
    return view('products.list', compact('products')); // Pass products data to the view
    }
    // This method will show create page
    public function create(){
        return view('products.create');
    }

    // This method will store a product in db
    public function store(Request $request){
        $rules = [
            'name'=> 'required|min:5',
            'sku'=> 'required|min:3',
            'price'=> 'required|numeric'
        ];

        if($request->image != ""){
            $rules['image'] = 'image';
        }

        $Validator = Validator::make($request->all(),$rules);

        if ($Validator->fails()){
            return redirect()->route('products.create')->withInput()->withErrors($Validator);
        }


        //here we will insert product in db
        $product = new Product();
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save();

        if($request->image != ""){
           //we will store image
        $image = $request->image;
        $ext = $image->getClientOriginalExtension();
        $imageName = time().'.'.$ext; //Unique image name

        //save images to products image directory
        $image->move(public_path('uploads/products'),$imageName);


        //Save image in databse
        $product->image = $imageName;
        $product->save();
        }

        return redirect()->route('products.index')->with('success', 'Product Added Successfully.');

    }
    // This method will show edit product page
    public function edit($id){
        $product = Product::findOrFail($id);
        return view('products.edit',[
           'product' => $product
        ]);

    }
    // This method will update a product
    public function update($id, Request $request){

        $product = Product::findOrFail($id);

        $rules = [
            'name'=> 'required|min:5',
            'sku'=> 'required|min:3',
            'price'=> 'required|numeric'
        ];

        if($request->image != ""){
            $rules['image'] = 'image';
        }

        $Validator = Validator::make($request->all(),$rules);

        if ($Validator->fails()){
            return redirect()->route('products.edit', $product->id)->withInput()->withErrors($Validator);
        }


        //here we will update product in db
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save();

        if($request->image != ""){

        //delete old image
        File::delete(public_path('uploads/products/' . $product->image));

        //we will store image
        $image = $request->image;
        $ext = $image->getClientOriginalExtension();
        $imageName = time().'.'.$ext; //Unique image name

        //save images to products image directory
        $image->move(public_path('uploads/products'),$imageName);


        //Save image in databse
        $product->image = $imageName;
        $product->save();
        }

        return redirect()->route('products.index')->with('success', 'Product Updated Successfully.');

    }
    // This method will delete a product
    public function destroy($id){

        $product = Product::findOrFail($id);

        //delete image
        File::delete(public_path('uploads/products/' . $product->image));

        //delete product from the databse
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product Deleted Successfully.');
    }
}

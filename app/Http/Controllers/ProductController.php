<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use URL;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        try {
            $products = Product::with('category')->get();

            $product_list = [];
            foreach ($products as $product) {
                $product_list[] = [
                    'id' => $product->id,
                    'name' => [
                        'ar' => $product->ar_name,
                        'en' => $product->en_name,
                    ],
                    'description' => [
                        'ar' => $product->ar_description,
                        'en' => $product->en_description,
                    ],
                    'price' => $product->price,
                    'calories' => $product->calories,
                    "image" => URL::to('/images/product/' . $product->image),
                    'category' => [
                        'id' => $product->category->id,
                        'name' => [
                            'ar' => $product->category->ar_name,
                            'en' => $product->category->en_name,
                        ],
                        "image" => URL::to('/images/category/' . $product->category->image),
                    ],
                ];
            }

            return $this->success($product_list, 'all products');
        } catch (\Exception $e) {
            if ($e->getCode() == 23000) {
                return $this->error($e);
            }
        }
    }

    public function category_product($id)
    {

        try {
            $products = Product::where('category_id', $id)->with('category')->get();

            $product_list = [];
            foreach ($products as $product) {
                $product_list[] = [
                    'id' => $product->id,
                    'name' => [
                        'ar' => $product->ar_name,
                        'en' => $product->en_name,
                    ],
                    'description' => [
                        'ar' => $product->ar_description,
                        'en' => $product->en_description,
                    ],
                    'price' => $product->price,
                    'calories' => $product->calories,
                    "image" => URL::to('/images/product/' . $product->image),
                    'category' => [
                        'id' => $product->category->id,
                        'name' => [
                            'ar' => $product->category->ar_name,
                            'en' => $product->category->en_name,
                        ],
                        "image" => URL::to('/images/category/' . $product->category->image),
                    ],
                ];
            }

            return $this->success($product_list, 'all products');
        } catch (\Exception $e) {
            if ($e->getCode() == 23000) {
                return $this->error($e);
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {
            $request->validate([
                'ar_name' => 'required',
                'en_name' => 'required',
                'ar_description' => 'required',
                'en_description' => 'required',
                'price' => 'required',
                'calories' => 'required',
                'image' => 'required|mimes:jpg,png,jpeg|max:5048',
                'category_id' => 'required',
            ]);

            $image_name = time() .  '.' . $request->image->extension();

            $request->image->move(public_path('images/product'), $image_name);

            $product = new Product();


            $product->ar_name = $request->ar_name;
            $product->en_name = $request->en_name;
            $product->ar_description = $request->ar_description;
            $product->en_description = $request->en_description;
            $product->price = $request->price;
            $product->calories = $request->calories;
            $product->image = $image_name;
            $product->category_id = $request->category_id;

            if ($product->save()) {
                return $this->success($product, "Product has been created");
            } else {
                return $this->error('Product has not been created');
            }
        } catch (\Exception $e) {
            if ($e->getCode() == 23000) {
                return $this->error($e);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {

            $request->validate([
                'ar_name' => 'required',
                'en_name' => 'required',
                'ar_description' => 'required',
                'en_description' => 'required',
                'price' => 'required',
                'calories' => 'required',
                'image' => 'required|mimes:jpg,png,jpeg|max:5048',
                'category_id' => 'required',
            ]);

            $image_name = time() .  '.' . $request->image->extension();

            $request->image->move(public_path('images/product'), $image_name);

            $product =  Product::find($id);


            unlink(public_path('/images/product/' . $product->image));

            $product->ar_name = $request->ar_name;
            $product->en_name = $request->en_name;
            $product->ar_description = $request->ar_description;
            $product->en_description = $request->en_description;
            $product->price = $request->price;
            $product->calories = $request->calories;
            $product->image = $image_name;
            $product->category_id = $request->category_id;

            if ($product->update()) {
                return $this->success($product, "Product has been updated");
            } else {
                return $this->error("Product has not been updated");
            }
        } catch (\Exception $e) {
            if ($e->getCode() == 23000) {
                return $this->error($e);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $product =  Product::find($id);

            unlink(public_path('/images/product/' . $product->image));

            if ($product->delete()) {
                return $this->success('Successfully product deleted');
            } else {
                return $this->error('Can\'t remove this product');
            }
        } catch (\Exception $e) {
            if ($e->getCode() == 23000) {
                return $this->error($e);
            }
        }
    }
}

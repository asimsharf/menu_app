<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use URL;
use Image;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $categories = Category::with('products')->get();

            $category_list = [];
            foreach ($categories as $category) {
                $product_list = [];
                foreach ($category->products as $product) {
                    $product_list[] = [
                        'id' => $product->id,
                        "name" => [
                            'ar' => $product->ar_name,
                            'en' => $product->en_name,
                        ],
                        "description" => [
                            'ar' => $product->ar_description,
                            'en' => $product->en_description,
                        ],
                        "price" => $product->price,
                        "calories" => $product->calories,
                        "image" => URL::to('/images/product/' . $product->image),

                    ];
                }
                $category_list[] = [
                    'id' => $category->id,
                    'name' => [
                        'ar' => $category->ar_name,
                        'en' => $category->en_name,
                    ],
                    "image" => URL::to('/images/category/' . $category->image),
                    'products' => $product_list
                ];
            }

            return $this->success($category_list, 'all categories');
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
                'image' => 'required|mimes:jpg,png,jpeg|max:5048',
            ]);

            $image_name = time() .  '.' . $request->image->extension();
            $request->image->move(public_path('images/category'), $image_name);

            $category = new Category();

            $category->ar_name = $request->ar_name;
            $category->en_name = $request->en_name;
            $category->image = $image_name;

            if ($category->save()) {
                return $this->success($category, "Category has been created");
            } else {
                return $this->error('Category has not been created', 404);
            }
        } catch (\Exception $e) {
            if ($e->getCode() == 23000) {
                return $this->error($e, 404);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {

            $request->validate([
                'ar_name' => 'required',
                'en_name' => 'required',
                'image' => 'required|mimes:jpg,png,jpeg|max:5048',
            ]);

            $image_name = time() .  '.' . $request->image->extension();

            $request->image->move(public_path('images/category'), $image_name);

            $category =  Category::find($id);

            unlink(public_path('/images/category/' . $category->image));

            $category->ar_name = $request->ar_name;
            $category->en_name = $request->en_name;
            $category->image = $image_name;

            if ($category->update()) {
                return $this->success($category, "Category has been updated");
            } else {
                return $this->error("Category has not been updated");
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
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $category =  Category::find($id);

            unlink(public_path('/images/category/' . $category->image));

            if ($category->delete()) {
                return $this->success('Successfully category deleted');
            } else {
                return $this->error('Can\'t remove this category');
            }
        } catch (\Exception $e) {
            if ($e->getCode() == 23000) {
                return $this->error($e);
            }
        }
    }
}

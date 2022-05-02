<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\Product\StoreRequest;
use App\Http\Requests\Product\UpdateRequest;
use Illuminate\Support\Facades\Storage;

/**
 * Class ProductController
 * @package App\Http\Controllers\Product
 */
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('product.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        try {
            /** @var  $input */
            $input = $request->validated();

            /** @var Image Uplaod $avatar_image */
            $product_image = $input['product_image'];
            $productPic = 'products/' . time() . '_' . mt_rand(1111, 9999) . '.' . $product_image->getClientOriginalExtension();
            $product_image->storeAs('public/', $productPic, env('STORAGE_DISKS'));

            /** Product Create Start */
            Product::create(array(
                'user_id' => auth('admin')->id(),
                'name' => $input['name'],
                'description' => $input['description'],
                'image' => $productPic,
            ));

            session()->flash('success', __('messages.addProductSuccess', ['name' => $input['name']])); // Session Flash Msg return
            return redirect()->route('admin.products.index');
        } catch (\Exception $e) {
            session()->flash('error', __('messages.serverError')); // Error return
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Product $product)
    {
        try {
            /** @var  $input */
            $input = $request->validated();

            /** @var Image Uplaod $avatar_image */
            $productPic = $product['image'];
            if (isset($input['product_image'])) {

                /** Already Exit file remove */
                if (isset($product['image']) && $product['image'] !== null) {
                    Storage::disk(env('STORAGE_DISKS'))->delete('public/' . $product['image']);
                }

                $product_image = $input['product_image'];
                $productPic = 'products/' . time() . '_' . mt_rand(1111, 9999) . '.' . $product_image->getClientOriginalExtension();
                $product_image->storeAs('public/', $productPic, env('STORAGE_DISKS'));
            }

            /** Update Product */
            $product->update(array(
                'name' => $input['name'],
                'description' => $input['description'],
                'image' => $productPic,
            ));

            session()->flash('success', __('messages.updateProductSuccess', ['name' => $input['name']])); // Session Flash Msg return
            return redirect()->route('admin.products.index');
        } catch (\Exception $e) {
            session()->flash('error', __('messages.serverError')); // Error return
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        try {
            $product->delete();
            return response()->json(array(
                'status' => "success",
                'message' => __('messages.deleteProductSuccess'),
            ));
        } catch (\Exception $e) {
            return response()->json(array(
                'status' => "error",
                'message' => __('messages.serverError'),
            ));
        }
    }
}

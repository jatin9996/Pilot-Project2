<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\Product\UpdateRequest;
use Illuminate\Support\Facades\Storage;

/**
 * Class ProductController
 * @package App\Http\Controllers\User
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
        //
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        /** @var  $product */
        $product = Product::where('id', $id)->first();
        if ($product === null) {
            abort(404);
        }
        return view('product.edit', ['product' => $product, 'user_product' => true]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        try {
            /** @var  $product */
            $product = Product::where('id', $id)->first();
            if ($product === null) {
                abort(404);
            }
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
            return redirect()->route('admin.users.show', ['user' => $product['user_id']]);
        } catch (\Exception $e) {
            dd($e->getMessage());
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
    public function destroy($id)
    {
        //
    }
}

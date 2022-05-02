<?php

namespace App\Http\Requests\Product;

use App\Http\Requests\BaseFormRequest;

/**
 * Class StoreRequest
 * @package App\Http\Requests\Product
 */
class StoreRequest extends BaseFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ["bail", "required", "string", "unique:products,name"],
            'description' => ["bail", "required", "string"],
            'product_image' => ["bail", "required", "max:2000", "mimes:jpeg,jpg,jpe,png"]
        ];
    }
}

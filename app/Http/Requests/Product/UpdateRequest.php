<?php

namespace App\Http\Requests\Product;

use App\Http\Requests\BaseFormRequest;

/**
 * Class UpdateRequest
 * @package App\Http\Requests\Product
 */
class UpdateRequest extends BaseFormRequest
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
        $r = request('user_product');
        if ($r === null) {
            return [
                'name' => ["bail", "required", "string", "unique:products,name," . request('product')->id],
                'description' => ["bail", "required", "string"],
                'product_image' => ["bail", "nullable", "max:2000", "mimes:jpeg,jpg,jpe,png"]
            ];
        } else {
            return [
                'name' => ["bail", "required", "string", "unique:products,name," . $r],
                'description' => ["bail", "required", "string"],
                'product_image' => ["bail", "nullable", "max:2000", "mimes:jpeg,jpg,jpe,png"]
            ];
        }
    }
}

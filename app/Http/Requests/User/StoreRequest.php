<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseFormRequest;

/**
 * Class StoreRequest
 * @package App\Http\Requests\User
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
            'first_name' => ['bail', 'required', 'string', "min:2", "max:255"],
            'last_name' => ['bail', 'required', 'string', "min:2", "max:255"],
            'email' => ["bail", "required", "string", "email", "unique:users,email"],
            'password' => ["bail", "required", "string"]
        ];
    }
}

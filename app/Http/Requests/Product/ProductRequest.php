<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'=>'required|string',
            'sku'=>'nullable|string',
            'brand_id'=>'nullable|integer',
            'description'=>'nullable|string',
            'short_description'=>'nullable|string',
            'price'=>'nullable|integer',
            'dis_price'=>'nullable|integer',
            'stock'=>'nullable|integer',
            'category_id'=>'nullable|integer',
        ];
    }
}

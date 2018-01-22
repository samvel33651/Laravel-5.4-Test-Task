<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreItemsRequest extends FormRequest
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
            'item_name' => 'required|min:2',
            'price' => 'required|numeric',
            'vendor' => 'required',
            'type_id' => 'required',
            'serial_number' => 'required',
            'color' =>'required',
            'release_date' => 'required|date',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
}

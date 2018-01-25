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

        switch($this->method())
        {
            case 'GET':
            case 'DELETE':
            case 'POST':
            {
                return [
                    'item_name' => 'required|min:2',
                    'price' => 'required|numeric',
                    'vendor_id' => 'required',
                    'weight' =>'required',
                    'type_id' => 'required',
                    'serial_number' => 'required',
                    'color' =>'required',
                    'release_date' => 'required|date|before_or_equal:today',
                    'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ];
            }
            case 'PUT':
            {
                if(isset($this->photo)){
                    return [
                        'item_name' => 'required|min:2',
                        'price' => 'required|numeric',
                        'vendor_id' => 'required',
                        'weight' =>'required',
                        'type_id' => 'required',
                        'serial_number' => 'required',
                        'color' =>'required',
                        'release_date' => 'required|date|before_or_equal:today',
                        'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    ];
                }

                return [
                    'item_name' => 'required|min:2',
                    'price' => 'required|numeric',
                    'vendor_id' => 'required',
                    'weight' =>'required',
                    'type_id' => 'required',
                    'serial_number' => 'required',
                    'color' =>'required',
                    'release_date' => 'required|date|before_or_equal:today',
                ];

            }
            case 'PATCH':

            default:break;
        }

    }
}

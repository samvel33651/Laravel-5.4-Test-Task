<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVendorsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return True;
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
                    'name' => 'required|min:2',
                    'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ];
            }
            case 'PUT':
            {
                if(isset($this->logo)){
                    return [
                        'name' => 'required|min:2',
                        'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
                    ];
                }

                return [
                    'name' => 'required|min:2',
                ];

            }
            case 'PATCH':

            default:break;
        }

    }
}

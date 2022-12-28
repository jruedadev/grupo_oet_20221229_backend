<?php

namespace App\Http\Requests\Vehicles;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CreateUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return !Auth::guest();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            'license_plate'     =>  'required|string|max:10|unique:vehicles',
            'color'             =>  'required|string|max:50',
            'brand'             =>  'required|string|max:100',
            'type'              =>  'required|string|in:public,private',
            'owner_id'          =>  'required|numeric',
        ];

        if (Request::isMethod('PUT') || Request::isMethod('PATCH')) {
            $rules['license_plate'] = $rules['license_plate'] . ',id,' . $this->route('vehicle');
        }

        return $rules;
    }
}

<?php

namespace App\Http\Requests\Owners;

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
            'type_document'     =>  'required|string|in:CC,CE,NIT,OTRO',
            'document'          =>  'required|string|max:20|unique:owners',

            'first_name'        =>  'required|string|max:50',
            'middle_name'       =>  'required|string|max:50',
            'last_name'         =>  'required|string|max:50',

            'address'           =>  'required|string|max:250',
            'phone'             =>  'required|string|max:20',
            'city'              =>  'required|string|max:100',
        ];

        if (Request::isMethod('PUT') || Request::isMethod('PATCH')) {
            $rules['document'] = $rules['document'] . ',id,' . $this->route('owner');
        }

        return $rules;
    }
}

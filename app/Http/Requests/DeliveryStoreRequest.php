<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DeliveryStoreRequest extends FormRequest
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
            'client_id' => ['required', 'integer', Rule::exists('users', 'id')->where(function ($query) {
                return $query->where('user_type_id', 1);
            })],
            'deliver_id' => ['sometimes', 'integer', Rule::exists('users', 'id')->where(function ($query) {
                return $query->where('user_type_id', 3);
            })],
            'collect_point' => ['required', 'array'],
            'destination_point' => ['required', 'array'],
        ];
    }
}

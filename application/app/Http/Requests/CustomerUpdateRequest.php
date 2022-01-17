<?php

namespace App\Http\Requests;

use App\Models\Customer;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class CustomerUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'first_name' => ['string', 'min:2', 'max:32'],
            'last_name' => ['string', 'min:2', 'max:32'],
            'email' => 'unique:users,email,'.$this->customer->id.'|email:rfc,dns|max:255',
            'phone' => ['regex:/(01)[0-9]{9}/'],
            'priority' => sprintf('in:%s', implode(',', array_values(Customer::$priorities))),
        ];
    }

    /**
     * @param Validator $validator
     * @return array
     */
    protected function formatErrors(Validator $validator): array
    {
        return $validator->errors()->all();
    }
}

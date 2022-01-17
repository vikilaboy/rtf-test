<?php

namespace App\Http\Requests;

use App\Models\Customer;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
            'first_name' => ['required', 'string', 'min:2', 'max:32'],
            'last_name' => ['required', 'string', 'min:2', 'max:32'],
            'email' => ['required', 'unique:customers', 'email:rfc,dns', 'max:128'],
            'phone' => ['required', 'regex:/(01)[0-9]{9}/'],
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

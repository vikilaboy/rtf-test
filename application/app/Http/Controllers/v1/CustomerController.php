<?php

namespace App\Http\Controllers\v1;

use App\Http\Requests\CustomerRequest;
use App\Http\Requests\CustomerUpdateRequest;
use App\Models\Customer;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\QueryBuilder\QueryBuilder;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): LengthAwarePaginator
    {
        return QueryBuilder::for(Customer::class)->allowedSorts([
            'id',
            'first_name',
            'last_name',
            'email',
            'phone',
            'priority',
            'created_at',
            'updated_at',
        ])->paginate($request->input('_pp', 10), ['*'], '_p', $request->input('_p', 1));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CustomerRequest $customerRequest): Customer
    {
        return Customer::create($customerRequest->validated());
    }

    /**
     * Display the specified resource.
     *
     * @param Customer $customer
     * @return Customer
     */
    public function show(Customer $customer): Customer
    {
        return $customer;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CustomerUpdateRequest $customerUpdateRequest, Customer $customer): Customer
    {
        $customer->update($customerUpdateRequest->validated());

        return $customer;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer): Response
    {
        $customer->delete();

        return response()->noContent();
    }
}

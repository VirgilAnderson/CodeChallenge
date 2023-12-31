<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the customers.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $customers = Customer::all();
        return response()->json($customers);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created customer in storage.
     *
     * @param  Request  $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'firstName' => 'required|max:255',
            'lastName' => 'required|max:255',
            'email' => 'required|email|unique:customers',
            'phoneNumber' => 'required',
            'address' => 'required',
        ]);

        $customer = Customer::create($validatedData);
        return response()->json($customer, 201);
    }

    /**
     * Display the specified customer.
     *
     * @param  Customer  $customer
     * @return JsonResponse
     */
    public function show(Customer $customer): JsonResponse
    {
        return response()->json($customer);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified customer in storage.
     *
     * @param  Request  $request
     * @param  Customer  $customer
     * @return JsonResponse
     */
    public function update(Request $request, Customer $customer): JsonResponse
    {
        $validatedData = $request->validate([
            'firstName' => 'max:255',
            'lastName' => 'max:255',
            'email' => 'email|unique:customers,email,' . $customer->id,
            'phone_number' => '',
            'address' => '',
        ]);

        $customer->update($validatedData);
        return response()->json($customer);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

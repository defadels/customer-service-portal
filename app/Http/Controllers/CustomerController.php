<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index(): JsonResponse
    // {
    //     $customers = Customer::with(['tickets'])->paginate(15);
    //     return response()->json($customers);
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:customers',
                'phone' => 'nullable|string|max:20',
                'address' => 'nullable|string',
                'city' => 'nullable|string|max:100',
                'state' => 'nullable|string|max:100',
                'postal_code' => 'nullable|string|max:20',
                'country' => 'nullable|string|max:100',
                'date_of_birth' => 'nullable|date',
                'gender' => 'nullable|in:M,F,Other',
                'customer_type' => 'nullable|in:New,Regular,VIP,Premium',
                'communication_preference' => 'nullable|in:Email,SMS,Phone',
                'language_preference' => 'nullable|string|max:10',
                'timezone' => 'nullable|string|max:50'
            ]);

            $customer = Customer::create($validated);
            return response()->json($customer, 201);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $customer = Customer::with(['tickets', 'chatMessages'])->findOrFail($id);
        return response()->json($customer);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        try {
            $customer = Customer::findOrFail($id);
            
            $validated = $request->validate([
                'name' => 'sometimes|string|max:255',
                'email' => 'sometimes|email|unique:customers,email,' . $id,
                'phone' => 'nullable|string|max:20',
                'address' => 'nullable|string',
                'city' => 'nullable|string|max:100',
                'state' => 'nullable|string|max:100',
                'postal_code' => 'nullable|string|max:20',
                'country' => 'nullable|string|max:100',
                'date_of_birth' => 'nullable|date',
                'gender' => 'nullable|in:M,F,Other',
                'customer_type' => 'nullable|in:New,Regular,VIP,Premium',
                'status' => 'nullable|in:Active,Inactive,Suspended',
                'communication_preference' => 'nullable|in:Email,SMS,Phone',
                'language_preference' => 'nullable|string|max:10',
                'timezone' => 'nullable|string|max:50'
            ]);

            $customer->update($validated);
            return response()->json($customer);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();
        return response()->json(null, 204);
    }

    /**
     * Search customers
     */
    public function search(Request $request): JsonResponse
    {
        $query = $request->get('q');
        $customers = Customer::where('name', 'like', "%{$query}%")
            ->orWhere('email', 'like', "%{$query}%")
            ->orWhere('phone', 'like', "%{$query}%")
            ->paginate(15);
        
        return response()->json($customers);
    }
}

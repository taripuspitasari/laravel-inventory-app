<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAddressRequest;
use App\Http\Requests\UpdateAddressRequest;
use App\Http\Resources\AddressResource;
use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $addresses = Address::where('user_id', $user->id)->get();

        return response(AddressResource::collection($addresses), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAddressRequest $request)
    {
        $data = $request->validated();
        $user = $request->user();

        Address::create([
            'user_id' => $user->id,
            'name' => $data['name'],
            'city' => $data['city'],
            'address' => $data['address'],
            'postal_code' => $data['postal_code'],
            'phone_number' => $data['phone_number']
        ]);

        $addresses = Address::where('user_id', $user->id)->get();

        return response(AddressResource::collection($addresses), 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $address = Address::findOrFail($id);

        return response(new AddressResource($address), 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAddressRequest $request, string $id)
    {
        $data = $request->validated();
        $user = $request->user();

        $address = Address::findOrFail($id);

        $address->update([
            'name' => $data['name'],
            'city' => $data['city'],
            'address' => $data['address'],
            'postal_code' => $data['postal_code'],
            'phone_number' => $data['phone_number']
        ]);

        $addresses = Address::where('user_id', $user->id)->get();

        return response(AddressResource::collection($addresses), 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $user = $request->user();

        $addres = Address::findOrFail($id);
        $addres->delete();

        $addresses = Address::where('user_id', $user->id)->get();

        return response(AddressResource::collection($addresses), 200);
    }
}

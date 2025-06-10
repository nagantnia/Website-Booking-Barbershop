<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingApiController extends Controller
{
    public function index()
    {
        return response()->json(Booking::with(['user', 'barber', 'services'])->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'full_name' => 'required|string',
            'phone_number' => 'required|string',
            'barber_id' => 'required|exists:barbers,id',
            'booking_datetime' => 'required|date',
            'services' => 'required|array'
        ]);

        $booking = Booking::create($request->except('services'));
        
        if ($request->has('services')) {
            foreach ($request->services as $serviceId) {
                $service = \App\Models\Pricing::find($serviceId);
                $booking->services()->attach($serviceId, ['price' => $service->harga]);
            }
        }

        return response()->json($booking->load(['user', 'barber', 'services']), 201);
    }

    public function show($id)
    {
        return response()->json(Booking::with(['user', 'barber', 'services'])->findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        $booking->update($request->except('services'));

        if ($request->has('services')) {
            $booking->services()->sync([]);
            foreach ($request->services as $serviceId) {
                $service = \App\Models\Pricing::find($serviceId);
                $booking->services()->attach($serviceId, ['price' => $service->harga]);
            }
        }

        return response()->json($booking->load(['user', 'barber', 'services']));
    }

    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->services()->detach();
        $booking->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}

<?php


namespace App\Http\Controllers;

use App\Models\Barber;
use App\Models\Pricing;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function create()
    {
        $pricing = Pricing::all();
        $barbers = Barber::all();
        
        return view('booking', compact('pricing', 'barbers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'services' => 'required|array',
            'barber_id' => 'required|exists:barbers,id',
            'booking_date' => 'required|date|after:today',
            'booking_time' => 'required'
        ]);
        $booking = Booking::create([
            'user_id' => Auth::id(),
            'full_name' => $request->full_name,
            'phone_number' => $request->phone_number,
            'barber_id' => $request->barber_id,
            'booking_datetime' => $request->booking_date . ' ' . $request->booking_time,
            'total_price' => 0,
            'status' => 'pending'
        ]);

        // Attach services and calculate total
        $totalPrice = 0;
        foreach ($request->services as $serviceId) {
            $service = Pricing::find($serviceId);
            $booking->services()->attach($serviceId, ['price' => $service->harga]);
            $totalPrice += $service->harga;
        }

        $booking->update(['total_price' => $totalPrice]);

        // Load the relationships needed for the receipt
        $booking->load(['services', 'barber']);

        return view('receipts.booking-receipt', compact('booking'));
    }
}
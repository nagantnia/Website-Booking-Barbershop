<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Barber;
use Illuminate\Http\Request;

class BarberApiController extends Controller
{
    public function index()
    {
        return response()->json(Barber::all());
    }

    public function store(Request $request)
    {
        $barber = Barber::create($request->all());
        return response()->json($barber, 201);
    }

    public function show($id)
    {
        return response()->json(Barber::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $barber = Barber::findOrFail($id);
        $barber->update($request->all());
        return response()->json($barber);
    }

    public function destroy($id)
    {
        Barber::destroy($id);
        return response()->json(['message' => 'Deleted successfully']);
    }
}

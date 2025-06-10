<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pricing;
use Illuminate\Http\Request;

class PricingApiController extends Controller
{
    public function index()
    {
        return response()->json(Pricing::all());
    }

    public function store(Request $request)
    {
        $pricing = Pricing::create($request->all());
        return response()->json($pricing, 201);
    }

    public function show($id)
    {
        return response()->json(Pricing::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $pricing = Pricing::findOrFail($id);
        $pricing->update($request->all());
        return response()->json($pricing);
    }

    public function destroy($id)
    {
        Pricing::destroy($id);
        return response()->json(['message' => 'Deleted']);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Services;
use Illuminate\Http\Request;

class ServicesApiController extends Controller
{
    public function index()
    {
        return response()->json(Services::all());
    }

    public function store(Request $request)
    {
        $service = Services::create($request->all());
        return response()->json($service, 201);
    }

    public function show($id)
    {
        return response()->json(Services::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $service = Services::findOrFail($id);
        $service->update($request->all());
        return response()->json($service);
    }

    public function destroy($id)
    {
        Services::destroy($id);
        return response()->json(['message' => 'Deleted']);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Collection;
use Illuminate\Http\Request;

class CollectionApiController extends Controller
{
    public function index()
    {
        return Collection::all();
    }

    public function store(Request $request)
    {
        return Collection::create($request->all());
    }

    public function show($id)
    {
        return Collection::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $collection = Collection::findOrFail($id);
        $collection->update($request->all());
        return $collection;
    }

    public function destroy($id)
    {
        Collection::destroy($id);
        return response()->json(['message' => 'Deleted']);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\Services;
use App\Models\Pricing;
use App\Models\Barber;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    public function index()
    {
        $data = [
            'services' => Services::all(),
            'collections' => Collection::all(),
            'pricing' => Pricing::all(),
            'barbers' => Barber::all()
        ];
        
        return view('index', $data);
    }
}
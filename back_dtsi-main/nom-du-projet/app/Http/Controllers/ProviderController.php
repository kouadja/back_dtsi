<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Provider;
use Illuminate\Http\Request;

class ProviderController extends Controller
{
    public function index()
    {
        return Provider::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'contact' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
        ]);

        $provider = Provider::create($request->all());

        return response()->json($provider, 201);
    }

    public function show(Provider $provider)
    {
        return $provider;
    }

    public function update(Request $request, Provider $provider)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'contact' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
        ]);

        $provider->update($request->all());

        return response()->json($provider, 200);
    }

    public function destroy(Provider $provider)
    {
        $provider->delete();

        return response()->json(null, 204);
    }
}

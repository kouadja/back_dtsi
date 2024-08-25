<?php

namespace App\Http\Controllers;

use App\Models\SiteModel;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index()
    {
        return SiteModel::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'site' => 'required|string|max:255',  
        ]);

        $site = SiteModel::create($request->all());

        return response()->json($site, 201);
    }

    public function show(SiteModel $site)
    {
        return $site;
    }

    public function update(Request $request, SiteModel $site)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'site' => 'required|string|max:255', 
        ]);

        $site->update($request->all());

        return response()->json($site, 200);
    }

    public function destroy(SiteModel $site)
    {
        $site->delete();

        return response()->json(null, 204);
    }
}

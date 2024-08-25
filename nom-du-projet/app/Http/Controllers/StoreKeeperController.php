<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StoreKeeper;

class StoreKeeperController extends Controller
{
    // Afficher la liste des store keepers
    public function index()
    {
        $storeKeepers = StoreKeeper::with('articles')->get();
        return response()->json($storeKeepers);
    }

    // Enregistrer un nouveau store keeper
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:store_keepers',
        ]);

        $storeKeeper = StoreKeeper::create($validatedData);
        return response()->json($storeKeeper, 201);
    }

    // Afficher un store keeper spécifique
    public function show($id)
    {
        $storeKeeper = StoreKeeper::with('articles')->find($id);

        if (!$storeKeeper) {
            return response()->json(['message' => 'Store Keeper not found'], 404);
        }

        return response()->json($storeKeeper);
    }

    // Mettre à jour un store keeper existant
    public function update(Request $request, $id)
    {
        $storeKeeper = StoreKeeper::find($id);

        if (!$storeKeeper) {
            return response()->json(['message' => 'Store Keeper not found'], 404);
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:store_keepers,email,' . $id,
        ]);

        $storeKeeper->update($validatedData);
        return response()->json($storeKeeper);
    }

    // Supprimer un store keeper
    public function destroy($id)
    {
        $storeKeeper = StoreKeeper::find($id);

        if (!$storeKeeper) {
            return response()->json(['message' => 'Store Keeper not found'], 404);
        }

        $storeKeeper->delete();
        return response()->json(['message' => 'Store Keeper deleted successfully']);
    }
}

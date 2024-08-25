<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AdminController extends Controller
{
    public function __construct()
    {
        // Appliquer le middleware 'admin' à toutes les méthodes de ce contrôleur
   /*      $this->middleware([ 'admin']); */
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Vérifier si l'utilisateur existe
        try {
            $user = User::findOrFail($id);

            // Vérifier les autorisations de l'utilisateur
          /*   if (Gate::denies('delete-user', $user)) {
                return response()->json(['message' => 'Unauthorized'], 403);
            } */

            // Supprimer l'utilisateur
            $user->delete();

            return response()->json(['message' => 'User deleted successfully.'], 200);

        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'User not found.'], 404);
        }
    }
}

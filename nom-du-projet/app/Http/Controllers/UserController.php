<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\StoreKeeper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            "role"=> "nullable|string",
            "type" => "nullable|string"
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            "role"=> $validated['role'],
            "type" =>$validated["type"]
        ]);

        if ($request->input('type') === 'store_keeper') {

         
            StoreKeeper::create([
                'user_id' => 1,
                
            ]);
        }

        return  response()->json([

         
            "user" => $user ,

        ]);
    }
    public function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|string|email',
                'password' => 'required|string',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            // Récupérer l'utilisateur par email
            $user = User::where('email', $request->email)->first();

            if (!$user) {
                return response()->json(['message' => 'Invalid credentials'], 401);
            }

            // Vérifier le mot de passe
            if (!Hash::check($request->password, $user->password)) {
                return response()->json(['message' => 'Invalid credentials'], 401);
            }

            // Générer un token pour l'utilisateur
          /*   $token = $user->createToken('API Token')->plainTextToken; */

            return response()->json(['user' => $user]);

        } catch (ValidationException $e) {
            return response()->json(['message' => 'Validation failed', 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Login failed', 'error' => $e->getMessage()], 500);
        }
    }
    public function getProfilById($id){
        try {
            $user = User::find($id);

            if ($user) {
                
                return response()->json(['user' => $user], 200);
            } else {
             
                return response()->json(['message' => 'User not found'], 404);
            }
        } catch (\Throwable $e) {
            return response()->json(['message' => 'echec', 'error' => $e->getMessage()], 500);
        }
       

    }
    public function updateUserProfil(Request $request, $id)
    {
        try {
            // Récupérer l'utilisateur par ID
            $user = User::findOrFail($id);

            // Valider les données de la requête
            $request->validate([
                'name' => 'sometimes|string|max:255',
                'email' => 'sometimes|string|email|max:255|unique:users,email,' . $user->id,
                'password' => 'sometimes|string|min:8',
            ]);

            // Mettre à jour les champs de l'utilisateur
            if ($request->has('name')) {
                $user->name = $request->input('name');
            }

            if ($request->has('email')) {
                $user->email = $request->input('email');
            }

            if ($request->has('password')) {
                $user->password = Hash::make($request->input('password'));
            }

            // Sauvegarder les modifications
            $user->save();

            return response()->json(['message' => 'Profile updated successfully', 'user' => $user], 200);

        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to update profile', 'error' => $e->getMessage()], 500);
        }
    }
    public function NewUser(){
        $users = User::whereNull('role')->get();

        return response()->json(['users' => $users], 200);
    }
      
}


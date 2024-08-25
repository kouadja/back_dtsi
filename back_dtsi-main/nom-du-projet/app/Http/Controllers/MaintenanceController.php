<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MaintenanceModel;

class MaintenanceController extends Controller
{
    public function index()
    {
        $maintenances = MaintenanceModel::all();

        if ($maintenances->isEmpty()) {
            return response()->json([
                "message" => "Il n'y a pas de maintenance"
            ]);
        }

        return response()->json($maintenances);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'statutTache' => 'nullable|string|max:255',
            'technicienAssigner' => 'nullable|string|max:255',
            'lieuTache' => 'required|string|max:255',
            'priorité' => 'nullable|string|max:255',
            'dateDebut' => 'nullable|date',
            'dateFin' => 'nullable|date',
            'statut' => 'nullable|string|max:255',
            'datedemande' => 'nullable|date',
            'solutionProposee' => 'nullable|string', // Ajout de la validation pour la solution proposée
        ]);
    
        // Appliquer les valeurs par défaut si les champs sont vides
        $validatedData['statutTache'] = $validatedData['statutTache'] ?? 'en_attente';
        $validatedData['priorité'] = $validatedData['priorité'] ?? 'moyenne';
        $validatedData['statut'] = $validatedData['statut'] ?? 'en_attente';
        $validatedData['datedemande'] = $validatedData['datedemande'] ?? now()->format('Y-m-d');
        $validatedData['dateDebut'] = $validatedData['dateDebut'] ?? null;
        $validatedData['dateFin'] = $validatedData['dateFin'] ?? null;
        $validatedData['technicienAssigner'] = $validatedData['technicienAssigner'] ?? null;
        $validatedData['solutionProposee'] = $validatedData['solutionProposee'] ?? null; // Valeur par défaut
    
        $maintenance = MaintenanceModel::create($validatedData);
    
        return response()->json($maintenance, 201);
    }
    

    
    

    public function show(string $id)
    {
        $maintenance = MaintenanceModel::find($id);

        if (!$maintenance) {
            return response()->json([
                "message" => "Maintenance non trouvée"
            ], 404);
        }

        return response()->json($maintenance);
    }

    public function update(Request $request, string $id)
    {
        $maintenance = MaintenanceModel::find($id);
    
        if (!$maintenance) {
            return response()->json([
                "message" => "Maintenance non trouvée"
            ], 404);
        }
    
        $validatedData = $request->validate([
            'titre' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'lieuTache' => 'sometimes|required|string|max:255',
            'priorité' => 'sometimes|nullable|string|max:255',
            'statutTache' => 'sometimes|nullable|string|max:255',
            'technicienAssigner' => 'sometimes|nullable|string|max:255',
            'dateDebut' => 'sometimes|nullable|date',
            'dateFin' => 'sometimes|nullable|date',
            'statut' => 'sometimes|nullable|string|max:255',
            'datedemande' => 'sometimes|nullable|date',
            'solutionProposee' => 'nullable|string', 
        ]);
    
        // Mettre à jour l'enregistrement
        $maintenance->update($validatedData);
    
        return response()->json($maintenance);
    }
    




    public function destroy(string $id)
    {
        $maintenance = MaintenanceModel::find($id);

        if (!$maintenance) {
            return response()->json([
                "message" => "Maintenance non trouvée"
            ], 404);
        }

        $maintenance->delete();

        return response()->json(null, 204);
    }
}

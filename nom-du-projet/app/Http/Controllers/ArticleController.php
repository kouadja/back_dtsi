<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{
    // Afficher la liste des articles
    public function index()
    {
        $articles = Article::all();
        return response()->json($articles);
    }

    // Afficher un formulaire pour créer un nouvel article
    public function create()
    {
        // Utilisé dans les applications web traditionnelles (pas nécessaire pour les APIs RESTful)
    }

    // Enregistrer un nouvel article
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom_article' => 'required|string|max:255',
            'description_article' => 'nullable|string',
            'quantite_article' => 'required|integer',
            'etat_article' => 'required',
            "id_store_keeper" => "required | exists:store_keepers,id_store_keeper",
        ]);
    
 

        $article = Article::create($validatedData);

        return response()->json($article, 201);
    }

    // Afficher un article spécifique
    public function show($id)
    {
        $article = Article::find($id);

        if (!$article) {
            return response()->json(['message' => 'Article not found'], 404);
        }

        return response()->json($article);
    }

    // Afficher un formulaire pour éditer un article existant
    public function edit($id)
    {
        // Utilisé dans les applications web traditionnelles (pas nécessaire pour les APIs RESTful)
    }

    // Mettre à jour un article existant
    public function update(Request $request, $id)
    {
        $article = Article::find($id);

        if (!$article) {
            return response()->json(['message' => 'Article not found'], 404);
        }

        $validatedData = $request->validate([
            "id_store_keeper" => "required",
            'nom_article' => 'required|string|max:255',
            'description_article' => 'nullable|string',
            'quantite_article' => 'required|integer',
            'etat_article' => 'required',
        ]);

        $article->update($validatedData);

        return response()->json($article);
    }

    // Supprimer un article
    public function destroy($id)
    {
        $article = Article::find($id);

        if (!$article) {
            return response()->json(['message' => 'Article not found'], 404);
        }

        $article->delete();

        return response()->json(['message' => 'Article deleted successfully']);
    }
}

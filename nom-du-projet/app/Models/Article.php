<?php

namespace App\Models;

use App\Models\StoreKeeper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory;
      // La clé primaire de la table
      protected $primaryKey = 'id_article';

      // Indique que l'identifiant de l'article est un entier
      public $incrementing = true;
  
      // Indique que la clé primaire n'est pas de type chaîne
      protected $keyType = 'int';
  
      // Définir les champs qui peuvent être mass-assignés
      protected $fillable = [
        'nom_article',
        'description_article',
        'quantite_article',
        'etat_article',
        'id_store_keeper',
    ];
      protected $attributes = [
        'etat_article' => "new", // Valeur par défaut pour l'état de l'article (true pour actif)
    ];
    public function storeKeeper()
    {
        return $this->belongsTo(StoreKeeper::class, 'id_store_keeper', 'id_store_keeper');
    }
}

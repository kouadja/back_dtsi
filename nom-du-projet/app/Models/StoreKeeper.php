<?php

namespace App\Models;

use App\Models\User;
use App\Models\Article;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StoreKeeper extends Model
{
    use HasFactory;
    protected $table = 'store_keepers';

    protected $primaryKey = 'id_store_keeper';
 public $incrementing = true;
    protected $fillable = [
        "user_id"
    ];

    // Clé primaire de la table

    
    public function articles()
    {
        return $this->hasMany(Article::class, 'id_store_keeper', 'id_store_keeper');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

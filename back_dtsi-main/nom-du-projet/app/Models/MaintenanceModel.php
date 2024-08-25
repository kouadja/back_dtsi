<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaintenanceModel extends Model
{
    use HasFactory;

    protected $table = 'maintenance_models';

    protected $fillable = [
        'titre',
        'description',
        'statutTache',
        'technicienAssigner',
        'lieuTache',
        'priorité',
        'dateDebut',
        'dateFin',
        'statut',
        'datedemande',
        'solutionProposee', 
    ];
}

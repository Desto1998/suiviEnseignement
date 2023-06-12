<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Programmer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var  string
     */

    protected $primaryKey = 'programmer_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'heure_debut',
        'heure_fin',
        'nombre_heure',
        'date_passage',
        'description',
        'est_dispenser',
        'cours_id',
        'salle_id',
        'deleted_at',
    ];

    public function cours(): HasOne
    {
        return $this->hasOne(Cours::class);
    }

}

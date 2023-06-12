<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatiereEnseigner extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var  string
     */

    protected $primaryKey = 'mat_esn_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'annee',
        'enseignantid',
        'deleted_at',
        'matiere_id',
    ];
}

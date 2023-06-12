<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Filieres extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var  string
     */

    protected $primaryKey = 'filiere_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'code_fil',
        'intitule_fil',
    ];

    public function matieres(): HasMany
    {
        return $this->hasMany(Matieres::class);
    }

    public function cours(): HasMany
    {
        return $this->hasMany(Cours::class);
    }

}

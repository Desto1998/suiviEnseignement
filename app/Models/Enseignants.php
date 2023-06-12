<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Enseignants extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var  string
     */

    protected $primaryKey = 'enseignant_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'matricule',
        'nom',
        'prenom',
        'tel',
        'email',
        'deleted_at',
    ];

    public function programmers(): HasMany
    {
        return $this->hasMany(Programmer::class);
    }

    public function cours(): HasMany
    {
        return $this->hasMany(Cours::class);
    }


}

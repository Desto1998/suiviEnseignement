<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cours extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var  string
     */

    protected $primaryKey = 'cours_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'duree',
        'libelle',
        'date_debut',
        'date_fin',
        'enseignant_id',
        'matiere_id',
        'filiere_id',
        'deleted_at',
    ];

//    public function phone(): HasOne
//    {
//        return $this->hasOne(Phone::class);
//    }
    public function programmers(): HasMany
    {
        return $this->hasMany(Programmer::class);
    }

    public function filiere(): BelongsTo
    {
        return $this->belongsTo(Filieres::class, 'foreign_key');
    }
    public function matiere(): BelongsTo
    {
        return $this->belongsTo(Filieres::class, 'foreign_key');
    }

    public function enseignant(): BelongsTo
    {
        return $this->belongsTo(Enseignants::class, 'foreign_key');
    }

}

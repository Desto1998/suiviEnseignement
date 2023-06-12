<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Matieres extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var  string
     */

    protected $primaryKey = 'matiere_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'code_mat',
        'intitule_mat',
        'filiere_id',
        'deleted_at',
    ];

    public function filiere(): BelongsTo
    {
        return $this->belongsTo(Filieres::class, 'foreign_key');
    }
}

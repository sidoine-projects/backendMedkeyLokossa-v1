<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compagnie extends Model
{
    use HasFactory;
    protected $table = 'compagnies_d_assurance';
    protected $fillable = [
        'nom', 'telephone', 'email', 'adresse',
    ];
}

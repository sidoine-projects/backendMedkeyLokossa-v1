<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModePayement extends Model
{
    use HasFactory;

    protected $table = 'mode_payements';

    protected $fillable = [
        'mode',
      
    ];

    
}

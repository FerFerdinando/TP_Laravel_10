<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class model_frog extends Model
{
    use HasFactory;

    protected $table = 'frog';
    
    protected $fillable = [
        'name',
        'color', 
        'age',
        'habitat',
        'is_poisonous',
        'description',
        'weight'
    ];
}

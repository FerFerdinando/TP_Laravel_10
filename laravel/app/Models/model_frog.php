<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class model_frog extends Model
{
    use HasFactory, SoftDeletes;

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

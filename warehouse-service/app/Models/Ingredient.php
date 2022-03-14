<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'stock',
    ];

    protected $casts = [
        'stock' => 'integer',
    ];

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }
}

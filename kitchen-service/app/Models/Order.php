<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    const STATUS_PENDING = 'pending';
    const STATUS_PROCESSING = 'processing';
    const STATUS_DELIVERED = 'delivered';

    use HasFactory;

    protected $fillable = [
        'recipe_id',
        'quantity',
        'status',
    ];

    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }
}

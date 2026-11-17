<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Equipment extends Model
{
    protected $table = 'equipment';

    protected $fillable = [
        'user_id',
        'equipment_name',
        'category',
        'unit_price',
        'description',
        'availability_status',
    ];

    public const CATEGORIES = ['Paddles', 'Balls', 'Nets', 'Accessories'];
    public const STATUSES   = ['available', 'unavailable'];

    protected function casts(): array
    {
        return [
            'unit_price' => 'decimal:2',
        ];
    }

    // An Equipment record belongs to a User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
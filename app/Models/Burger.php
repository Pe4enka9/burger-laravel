<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Burger extends Model
{
    protected $fillable = [
        'name',
        'description',
        'category_id',
        'image',
        'slug',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeFilter($query, array $filters)
    {
        if (!empty($filters['category']) && $filters['category'] != 'all') {
            $query->where('category_id', $filters['category']);
        }

        if (!empty($filters['sorting']) && $filters['sorting'] == 'desc') {
            $query->orderBy('created_at', 'DESC');
        } else {
            $query->orderBy('created_at', 'ASC');
        }

        return $query;
    }
}

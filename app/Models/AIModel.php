<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AIModel extends Model
{
    protected $table = "ai_models";

    protected $fillable = [
        'category_id',
        'key',
        'name',
        'slug',
        'description',
        'type',
        'is_active'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

}

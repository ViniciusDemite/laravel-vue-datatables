<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;

    public function class(): BelongsTo
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }

    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class);
    }

    public function scopeSearch($query, string $term) {
        $term = "%{$term}%";

        $query->where(function($query) use ($term) {
            $query->where('name', 'like', $term)
                ->orWhere('email', 'like', $term)
                ->orWhere('address', 'like', $term)
                ->orWhere('phone_number', 'like', $term)
                ->orWhereHas('class', function($query) use ($term) {
                    $query->where('name', 'like', $term);
                })
                ->orWhereHas('section', function($query) use ($term) {
                    $query->where('name', 'like', $term);
                });
        });
    }
}

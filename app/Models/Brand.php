<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'category_id'];

    public function category(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }
}

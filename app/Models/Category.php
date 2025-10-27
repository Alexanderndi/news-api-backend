<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Article;

/**
 * App\Models\Category
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Article[] $articles
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereSlug($value)
 */
class Category extends Model
{
    protected $fillable = [
        'name', 'slug'
    ];

    public function articles(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
    return $this->hasMany(Article::class);
    }
}

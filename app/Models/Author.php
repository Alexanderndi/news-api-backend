<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Article;

/**
 * App\Models\Author
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Article[] $articles
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Author whereName($value)
 */

class Author extends Model
{
    protected $fillable = [
        'name', 'bio', 'avatar_url'
    ];

    public function articles(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Article::class);
    }
}

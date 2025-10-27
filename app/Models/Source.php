<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Article;

/**
 * App\Models\Source
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Article[] $articles
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Source whereApiId($value)
 */
class Source extends Model
{
    protected $fillable = [
        'name', 'api_id', 'url', 'logo_url'
    ];

    public function articles(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Article::class);
    }
}

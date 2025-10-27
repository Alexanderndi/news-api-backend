<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Source;
use App\Models\Category;
use App\Models\Author;

/**
 * App\Models\Article
 *
 * @property-read \App\Models\Source|null $source
 * @property-read \App\Models\Category|null $category
 * @property-read \App\Models\Author|null $author
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereSourceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereAuthorId($value)
 */
class Article extends Model
{
    protected $fillable = [
        'title', 'description', 'content', 'url', 'image_url', 'published_at', 'source_id', 'category_id', 'author_id'
    ];

    public function source(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Source::class);
    }

    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function author(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Author::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
    protected $fillable = [
        'name', 'api_id', 'url', 'logo_url'
    ];

    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}

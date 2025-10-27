<?php

namespace App\Services\News;

use Illuminate\Support\Facades\Http;

class NewsApiFetcher implements NewsFetcherInterface
{
    public function fetchArticles(array $params = []): array
    {
        // TODO: Implement NewsAPI.org fetching logic
        return [];
    }
}

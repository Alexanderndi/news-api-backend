<?php

namespace App\Services\News;

use Illuminate\Support\Facades\Http;

class GuardianFetcher implements NewsFetcherInterface
{
    public function fetchArticles(array $params = []): array
    {
        // TODO: Implement The Guardian API fetching logic
        return [];
    }
}

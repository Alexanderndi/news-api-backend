<?php

namespace App\Services\News;

use Illuminate\Support\Facades\Http;

class NewsApiFetcher implements NewsFetcherInterface
{
    public function fetchArticles(array $params = []): array
    {

    $apiKey = config('services.newsapi.key');
        $endpoint = 'https://newsapi.org/v2/top-headlines';
        $query = array_merge([
            'country' => 'us',
            'pageSize' => 20,
        ], $params);
        $query['apiKey'] = $apiKey;

        $response = Http::get($endpoint, $query);
        if (!$response->ok() || empty($response['articles'])) {
            return [];
        }
        $results = [];
        foreach ($response['articles'] as $item) {
            $results[] = [
                'title' => $item['title'] ?? '',
                'description' => $item['description'] ?? '',
                'content' => $item['content'] ?? '',
                'url' => $item['url'] ?? '',
                'image_url' => $item['urlToImage'] ?? null,
                'published_at' => $item['publishedAt'] ?? null,
                'source_api_id' => $item['source']['id'] ?? null,
                'source_name' => $item['source']['name'] ?? null,
                'source_url' => null,
                'source_logo_url' => null,
                'category' => $params['category'] ?? null,
                'author' => $item['author'] ?? null,
            ];
        }
        return $results;
    }
}

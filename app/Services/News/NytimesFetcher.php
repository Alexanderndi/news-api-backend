<?php

namespace App\Services\News;

use Illuminate\Support\Facades\Http;

class NytimesFetcher implements NewsFetcherInterface
{
    public function fetchArticles(array $params = []): array
    {
    $apiKey = config('services.nytimes.key');
        $endpoint = 'https://api.nytimes.com/svc/topstories/v2/home.json';
        $query = array_merge([
            'api-key' => $apiKey,
        ], $params);

        $response = Http::get($endpoint, $query);
        if (!$response->ok() || empty($response['results'])) {
            return [];
        }
        $results = [];
        foreach ($response['results'] as $item) {
            $results[] = [
                'title' => $item['title'] ?? '',
                'description' => $item['abstract'] ?? '',
                'content' => $item['abstract'] ?? '',
                'url' => $item['url'] ?? '',
                'image_url' => $item['multimedia'][0]['url'] ?? null,
                'published_at' => $item['published_date'] ?? null,
                'source_api_id' => 'nytimes',
                'source_name' => 'New York Times',
                'source_url' => 'https://www.nytimes.com',
                'source_logo_url' => null,
                'category' => $item['section'] ?? null,
                'author' => $item['byline'] ?? null,
            ];
        }
        return $results;
    }
}

<?php

namespace App\Services\News;

use Illuminate\Support\Facades\Http;

class GuardianFetcher implements NewsFetcherInterface
{
    public function fetchArticles(array $params = []): array
    {
    $apiKey = config('services.guardian.key');
        $endpoint = 'https://content.guardianapis.com/search';
        $query = array_merge([
            'api-key' => $apiKey,
            'show-fields' => 'headline,trailText,body,thumbnail,byline',
            'page-size' => 20,
        ], $params);

        $response = Http::get($endpoint, $query);
        if (!$response->ok() || empty($response['response']['results'])) {
            return [];
        }
        $results = [];
        foreach ($response['response']['results'] as $item) {
            $fields = $item['fields'] ?? [];
            $results[] = [
                'title' => $fields['headline'] ?? $item['webTitle'] ?? '',
                'description' => $fields['trailText'] ?? '',
                'content' => $fields['body'] ?? '',
                'url' => $item['webUrl'] ?? '',
                'image_url' => $fields['thumbnail'] ?? null,
                'published_at' => $item['webPublicationDate'] ?? null,
                'source_api_id' => 'the-guardian',
                'source_name' => 'The Guardian',
                'source_url' => 'https://www.theguardian.com',
                'source_logo_url' => null,
                'category' => $item['sectionName'] ?? null,
                'author' => $fields['byline'] ?? null,
            ];
        }
        return $results;
    }
}

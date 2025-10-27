<?php

namespace App\Jobs;


use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Services\News\NewsApiFetcher;
use App\Services\News\GuardianFetcher;
use App\Services\News\NytimesFetcher;
use App\Models\Article;
use App\Models\Source;
use App\Models\Category;
use App\Models\Author;
use Illuminate\Support\Str;

class FetchNewsJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $fetchers = [
            new NewsApiFetcher(),
            new GuardianFetcher(),
            new NytimesFetcher(),
        ];

        foreach ($fetchers as $fetcher) {
            $articles = $fetcher->fetchArticles();
            foreach ($articles as $data) {
                // Find or create source
                $source = Source::firstOrCreate([
                    'api_id' => $data['source_api_id'] ?? null,
                ], [
                    'name' => $data['source_name'] ?? 'Unknown',
                    'url' => $data['source_url'] ?? null,
                    'logo_url' => $data['source_logo_url'] ?? null,
                ]);

                // Find or create category
                $category = null;
                if (!empty($data['category'])) {
                    $category = Category::firstOrCreate([
                        'slug' => Str::slug($data['category']),
                    ], [
                        'name' => $data['category'],
                    ]);
                }

                // Find or create author
                $author = null;
                if (!empty($data['author'])) {
                    $author = Author::firstOrCreate([
                        'name' => $data['author'],
                    ]);
                }

                // Store article if not exists
                Article::updateOrCreate([
                    'url' => $data['url'],
                ], [
                    'title' => $data['title'],
                    'description' => $data['description'] ?? null,
                    'content' => $data['content'] ?? null,
                    'image_url' => $data['image_url'] ?? null,
                    'published_at' => $data['published_at'] ?? null,
                    'source_id' => $source->id,
                    'category_id' => $category?->id,
                    'author_id' => $author?->id,
                ]);
            }
        }
    }
}

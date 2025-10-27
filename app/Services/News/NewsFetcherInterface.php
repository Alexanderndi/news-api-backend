<?php

namespace App\Services\News;

interface NewsFetcherInterface
{
    public function fetchArticles(array $params = []): array;
}

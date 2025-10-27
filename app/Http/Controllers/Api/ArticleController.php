<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Database\Eloquent\Builder;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Article::query()->with(['source', 'category', 'author']);

        // Filtering
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }
        if ($request->filled('source_id')) {
            $query->where('source_id', $request->source_id);
        }
        if ($request->filled('author_id')) {
            $query->where('author_id', $request->author_id);
        }
        if ($request->filled('date')) {
            $query->whereDate('published_at', $request->date);
        }

        // Search
        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function (Builder $sub) use ($q) {
                $sub->where('title', 'like', "%$q%")
                    ->orWhere('description', 'like', "%$q%")
                    ->orWhere('content', 'like', "%$q%")
                    ->orWhereHas('author', function ($a) use ($q) {
                        $a->where('name', 'like', "%$q%") ;
                    });
            });
        }

        $articles = $query->orderByDesc('published_at')->paginate(20);
        return response()->json($articles);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $article = Article::with(['source', 'category', 'author'])->findOrFail($id);
        return response()->json($article);
    }
    /**
     * Search articles by query and filters (alternative endpoint)
     */
    public function search(Request $request)
    {
        return $this->index($request);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

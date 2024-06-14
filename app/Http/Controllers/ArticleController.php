<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Categorie;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    public function index()
    {
        // Fetch all articles with their categories and tags
        $articles = Article::with(['category', 'tags'])->get();
        $categories = Categorie::all();

        // Pass the articles to the welcome view
        return view('welcome', compact('articles', 'categories'));
    }

    public function show($id)
    {
        $article = Article::with('category', 'tags', 'comments.user')->findOrFail($id);
        return view('article.detail', compact('article'));
    }

    public function create()
    {
        $categories = Categorie::all();
        $tags = Tag::all();
        return view('article.create', compact('categories', 'tags'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'array|exists:tags,id' // Validate tags input
        ]);

        $article = new Article();
        $article->title = $request->title;
        $article->description = $request->description;
        $article->categorieId = $request->category_id; // Map category_id to categorieId
        $article->usersId = Auth::id(); // Get the authenticated user's ID

        $article->save();

        // Attach tags to the article
        $article->tags()->attach($request->tags);

        return redirect()->route('dashboard')->with('success', 'Article created successfully.');
    }

    public function dashboard()
    {
        // Fetch all articles with their categories and tags
        $articles = Article::with(['category', 'tags'])->get();
        $categories = Categorie::all();

        // Pass the articles to the dashboard view
        return view('dashboard', compact('articles', 'categories'));
    }

    public function edit(Article $article)
    {
        $categories = Categorie::all(); // Retrieve all categories to display in the dropdown
        $tags = Tag::all(); // Retrieve all tags to display in the multi-select
        $articleTags = $article->tags->pluck('id')->toArray(); // Get the tag ids associated with the article
        return view('article.edit', compact('article', 'categories', 'tags', 'articleTags'));
    }

    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'array|exists:tags,id' // Validate tags input
        ]);

        $article->title = $request->title;
        $article->description = $request->description;
        $article->categorieId = $request->category_id; // Update the category ID
        $article->save();

        // Sync tags with the article
        $article->tags()->sync($request->tags);

        return redirect()->route('dashboard')->with('success', 'Article updated successfully.');
    }

    public function destroy(Article $article)
    {
        // Check if the currently authenticated user is authorized to delete the article

        if (auth()->user()->id == $article->usersid) {
            // Detach tags associated with the article
            $article->tags()->detach();

            // Delete associated comments
            $article->comments()->delete();

            // Delete the article
            $article->delete();

            // Redirect back with a success message
            return redirect()->route('dashboard')->with('success', 'Article and associated comments have been successfully deleted.');
        }

        // Redirect back with an error message if the user is not authorized
        return back()->withErrors(['failed' => 'You do not have permission to delete this article.']);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Categorie;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Show the form for creating a new category.
     */
    public function create()
    {
        // Retrieve categories
        $category = Categorie::all();

        // Pass categories to the view
        return view('category.create', ['categories' => $category]);
    }
    
    /**
     * Display a listing of the categories.
     */
    public function index()
    {
        // Retrieve categories
        $categories = Categorie::all();

        // Pass categories to the view
        return view('category.show', ['categories' => $categories]);
    }

    /**
     * Store a newly created category in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        Categorie::create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('dashboard')->with('success', 'Category created successfully.');
    }

    /**
     * Show the form for editing the specified category.
     */
    public function edit(Categorie $category)
    {
        return view('category.edit', compact('category'));
    }

    /**
     * Update the specified category in storage.
     */
    public function update(Request $request, Categorie $category)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $category->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified category from storage.
     */
    // public function destroy(Categorie $category)
    // {
      
    public function destroy($id)
{
    $category = Categorie::find($id);

    if (!$category) {
        return redirect()->route('categories.index')->with('error', 'Category not found.');
    }

    $defaultCategory = Categorie::firstOrCreate([
        'title' => 'ongecategoriseerd',
        'description' => 'geen categorie',
    ]);

    Article::where('categorieId', $category->id)->update(['categorieId' => $defaultCategory->id]);

    $category->delete();

    return redirect()->route('categories.index')->with('success', 'Category deleted successfully, and articles were re-categorized.');
}

}
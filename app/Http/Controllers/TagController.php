<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{
    public function edit(Tag $tag)
    {
        return view('tags.edit', compact('tag'));
    }

    public function create()
    {
        return view('tags.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $tag = new Tag();
        $tag->title = $request->title;
        $tag->description = $request->description;
        $tag->save();

        return redirect()->route('dashboard')->with('success', 'Tag created successfully.');
    }

    public function update(Request $request, Tag $tag)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $tag->title = $request->title;
        $tag->description = $request->description;
        $tag->save();

        return redirect()->route('tags.show')->with('success', 'Tag updated successfully.');
    }
    
    public function index()
    {
        $tags = Tag::all();
        return view('tags.show', ['tags' => $tags]);
    }
    public function destroy(Tag $tag)
{
    // Delete the tag
    $tag->delete();

    // Redirect back with success message
    return redirect()->route('tags.show')->with('success', 'Tag deleted successfully.');
}

}


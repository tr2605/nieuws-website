<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, Article $article)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $comment = new Comment();
        $comment->title = $request->title;
        $comment->description = $request->description;
        $comment->usersid = Auth::user()->id;
        $comment->articlesid = $article->id;
        $comment->save();

        return redirect()->back()->with('success', 'Comment posted successfully.');
    }
    public function edit(Comment $comment)
    {
        return view('comment.edit', compact('comment'));
    }

    public function update(Request $request, Comment $comment)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);
    
        $comment->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);
    
        return redirect()->route('dashboard')->with('success', 'Comment updated successfully.');
    }
    public function destroy(Comment $comment)
{
    $comment->delete();

    return redirect()->back()->with('success', 'Comment deleted successfully.');
}

}    

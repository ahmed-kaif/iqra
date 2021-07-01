<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'text'=>'required|string',
        ]);
        $comment = new Comment();
        $comment->text = $request->text;
        $comment->article_id = $request->article;
        $comment->user_id = auth()->user()->id;

        $comment->save();

    }

    public function show(Comment $comment)
    {
        //
    }

    public function edit(Comment $comment)
    {

    }

    public function update(Request $request, Comment $comment)
    {
        $request->validate([
            'text'=>'required|string',
        ]);

        $comment->text = $request->text;
        $comment->save();
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
    }
}

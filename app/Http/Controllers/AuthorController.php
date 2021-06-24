<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\Request;

class AuthorController extends Controller
{

    public function index()
    {
        $authors = Author::orderBy('name')->paginate(15);
        return view('Authors.index', compact('authors'));
    }

    public function create(Book $book)
    {
        return view('Authors.create', compact('book'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|min:3|string',
        ]);

        $author = new Author();
        $author->book_id = $request->book;
        $author->name = $request->name;

        if($author->save()){
            return redirect()->route('books.show', $request->book)->with('success', 'Record Created Successfully.');
        }
        else
            return back()->with('error', "Error! Record Couldn't be Created.");

    }

    public function edit(Author $author)
    {
        return view('Authors.edit', compact('author'));
    }

    public function update(Request $request, Author $author)
    {
        $request->validate([
            'name'=>'required|min:3|string',
        ]);

        $author->name = $request->name;

        if($author->save()){
            return redirect()->route('authors.index')->with('success', 'Record Updated Successfully.');
        }
        else
            return back()->with('error', "Error! Record Couldn't be Updated.");



    }

    public function destroy(Author $author)
    {
        if($author->delete()){
            return redirect()->route('authors.index')->with('success', 'Record Deleted Successfully.');
        }
        else
            return back()->with('error', "Error! Record Couldn't be Deleted.");
    }
}

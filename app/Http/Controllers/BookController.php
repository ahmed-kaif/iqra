<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::orderBy('title')->paginate(12);
        return view('Books.index', compact('books'));
    }

    public function create()
    {
        return view('Books.create');
    }

    public function store(Request $request)
    {
        $request->validate([
           'title'=>'required|string|min:4|unique:books,title',
           'publisher'=>'required|string|min:4',
           'isbn'=>'required|regex:/(?=(?:\D*\d){10}(?:(?:\D*\d){3})?$)/|unique:books,isbn',
           'image'=>'nullable|file|mimes:png,jpg,jpeg|max:128',
        ]);

        $book = new Book();
        $book->title = $request->title;
        $book->publisher = $request->publisher;
        $book->isbn = $request->isbn;

        if($request->hasFile('image')){
            $path = $request->file('image')->store('book-images');
            $book->image = $path;
        }

        if($book->save()){
            return redirect()->route('books.show', $book)->with('success', 'Record Created Successfully.');
        }
        else
            return back()->with('error', "Error! Record Couldn't be Created.");

    }

    public function show(Book $book)
    {
        return view('Books.show', compact('book'));
    }

    public function edit(Book $book)
    {
        return view('Books.edit', compact('book'));
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title'=>'required|string|min:4|unique:books,title,'.$book->id,
            'publisher'=>'required|string|min:4',
            'isbn'=>'required|regex:/(?=(?:\D*\d){10}(?:(?:\D*\d){3})?$)/|unique:books,isbn,'.$book->id,
            'image'=>'nullable|file|mimes:png,jpg,jpeg|max:128',
        ]);

        $book->title = $request->title;
        $book->publisher = $request->publisher;
        $book->isbn = $request->isbn;

        //updated Image in another method

        if($book->save()){
            return redirect()->route('books.show', $book)->with('success', 'Record Updated Successfully.');
        }
        else
            return back()->with('error', "Error! Record Couldn't be Created.");
    }

    public function destroy(Book $book)
    {
        if ($book->delete())
            return back()->with('success', 'Record Deleted Successfully.'); //session message Session::has('success')
        else
            return back()->with('error', "Error! Record Couldn't be Deleted."); //session message Session::has('error')
    }

    public function changeImageForm(Book $book)
    {
        return view('Books.change-image', compact('book'));
    }

    public function changeImage(Request $request, Book $book)
    {
        $oldImage = $book->getOriginal('image');

        if ($request->hasFile('image'))
        {
            if (Storage::exists($oldImage))
            {
                Storage::delete($oldImage);
            }
            $path = $request->file('image')->store('book-images');
            $book->image = $path;
        }

        if($book->save()){
            return redirect()->route('books.show', $book)->with('success', 'Image Uploaded Successfully.');
        }
        else
            return back()->with('error', "Error! Record Couldn't be Created.");
    }
}

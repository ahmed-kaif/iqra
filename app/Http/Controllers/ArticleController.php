<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::latest()->paginate(5);
        return view('Articles.index', compact('articles'));
    }

    public function create()
    {
        $books = Book::orderBy('title')->get();
        return view('Articles.create', compact('books'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required|string|min:4|unique:articles,title',
            'excerpt'=>'required|string|min:4|unique:articles,excerpt',
            'description'=>'required|string|min:10',
            'image'=>'nullable|file|mimes:png,jpg,jpeg|max:128',
        ]);

        $article = new Article();
        $article->title = $request->title;
        $article->excerpt = $request->excerpt;
        $article->description = $request->description;
        $article->book_id = $request->book;
        $article->user_id = auth()->user()->id; //auth user id

        //storing image
        if($request->hasFile('image'))
        {
            $path = $request->file('image')->store('article-images');
            $article->image = $path;
        }
        if($article->save()){
            return redirect()->route('articles.show', $article)->with('success', 'Record Created Successfully.');
        }
        else
            return back()->with('error', "Error! Record Couldn't be Created.");
    }

    public function show(Article $article)
    {
        return view('Articles.show', compact('article'));
    }

    public function edit(Article $article)
    {
        return view('articles.edit', compact('article'));
    }

    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title'=>'required|string|min:4|unique:articles,title,'.$article->id,
            'excerpt'=>'required|string|min:4|unique:articles,excerpt,'.$article->id,
            'description'=>'required|string|min:10',
        ]);

        $article->title = $request->title;
        $article->excerpt = $request->excerpt;
        $article->description = $request->description;

        if($article->save()){
            return redirect()->route('articles.show', $article)->with('success', 'Record Updated Successfully.');
        }
        else
            return back()->with('error', "Error! Record Couldn't be Updated.");

    }

    public function destroy(Article $article)
    {
        if ($article->delete())
            return redirect()->route('articles.index')->with('success', 'Record Deleted Successfully.'); //session message Session::has('success')
        else
            return back()->with('error', "Error! Record Couldn't be Deleted."); //session message Session::has('error')
    }

    public function changeImageForm(Article $article)
    {
        return view('Articles.change-image', compact('article'));
    }

    public function changeImage(Request $request, Article $article)
    {
        $oldImage = $article->getOriginal('image');

        if($request->hasFile('image'))
        {
            if(Storage::exists($oldImage))
            {
                Storage::delete($oldImage);
            }
        }

        $path = $request->file('image')->store('article-images');
        $article->image = $path;

        if($article->save()){
            return redirect()->route('articles.show', $article)->with('success', 'Image Updated Successfully.');
        }
        else
            return back()->with('error', "Error! Image Couldn't be Uploaded.");
    }
}

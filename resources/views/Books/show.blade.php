@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <img class="img rounded-sm" src="{{ $book->image ?? asset('images/No_Image_Available.jpg') }}" alt="Book image" height="300px" width="100%">
            </div>
            <div class="col-md-6 pl-5">
                <table class="table">
                    <tr>
                        <td>Title</td>
                        <td>{{$book->title}}</td>
                    </tr>
                    <tr>
                        <td>Author(s)</td>
                        <td>@forelse($book->authors as $author){{ $author->name }} <a href="{{route('authors.edit', $author)}}" class="small text-underline grow">Edit</a>
                            @continue($loop->last),
                            @empty
                                N/A
                            @endforelse</td>
                    </tr>
                    <tr>
                        <td>Publisher</td>
                        <td>{{$book->publisher}}</td>
                    </tr>
                    <tr>
                        <td>ISBN</td>
                        <td>{{$book->isbn}}</td>
                    </tr>
                </table>
            </div>
        </div>
        <hr>
        <div class="d-flex">
            <a href="{{ route('author.create', $book) }}" class="btn btn-outline-primary">Add Author</a>
            <a href="{{ route('change.image.form', $book) }}" class="btn btn-outline-success ml-1">Change Image</a>
            <a href="{{route('books.edit', $book)}}" class="btn btn-primary ml-1">Edit</a>
            <form action="{{route('books.destroy', $book)}}" method="post">
                @method('DELETE')
                @csrf
                <button type="submit" class="btn btn-danger ml-1">Delete</button>
            </form>
        </div>
    </div>

@endsection

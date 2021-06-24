@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <img class="card-img-top" src="{{ $book->image ?? asset('images/No_Image_Available.jpg') }}" alt="Book image" height="300px" width="100%">
            </div>
            <div class="col-md-6 pl-5">
                <table class="table border-top-0">
                    <tr>
                        <td>Title</td>
                        <td>{{$book->title}}</td>
                    </tr>
                    <tr>
                        <td>Author(s)</td>
                        <td>@forelse($book->authors as $author){{ $author->name }}@continue($loop->last),
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
            <a href="{{route('books.edit', $book)}}" class="btn btn-primary ml-1">Edit</a>
            <form action="{{route('books.destroy', $book)}}" method="post">
                @method('DELETE')
                @csrf
                <button type="submit" class="btn btn-danger ml-1">Delete</button>
            </form>
        </div>
    </div>

@endsection

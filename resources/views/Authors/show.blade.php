@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <img class="card-img-top" src="{{ $book->image ?? asset('images/No_Image_Available.jpg') }}" alt="Book image" height="300px" width="100%">
            </div>
            <div class="col-md-6 pl-5">
                <h2>{{$book->title}}</h2>
                <h5>Author</h5>
                <h5>{{$book->publisher}}</h5>
                <h5>{{$book->isbn}}</h5>
            </div>
        </div>
        <hr>
        <div class="d-flex">
            <a href="{{route('books.edit', $book)}}" class="btn btn-primary">Edit</a>
            <form action="{{route('books.destroy', $book)}}" method="post">
                @method('DELETE')
                @csrf
                <button type="submit" class="btn btn-danger ml-1">Delete</button>
            </form>
        </div>
    </div>

@endsection

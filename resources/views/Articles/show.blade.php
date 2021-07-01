@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <img class="img rounded-sm" src="{{ $article->image ?? asset('images/No_Image_Available.jpg') }}" alt="Article image" height="300px" width="100%">
            </div>
        </div>
        <br>
        <div class="d-flex justify-content-between">
            <h2 class="text-left font-weight-bolder">{{$article->title}}</h2>
            <div class="dropdown">
                <button class="bg-transparent border-0" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i data-feather="more-horizontal"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right text-right" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="{{ route('articles.edit', $article) }}">Edit</a>
                    <a class="dropdown-item" href="{{ route('articles.change.image', $article) }}">Change Image</a>
                    <form action="{{ route('articles.destroy', $article) }}" method="post">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="dropdown-item">Delete</button>
                    </form>
                </div>
            </div>
        </div>

        <hr>
        <div class="d-flex">
            <div class="flex-column">
                <img src="{{$article->book->image ?? asset('images/No_Image_Available.jpg')}}" height="75px" width="50px" alt="">
            </div>
            <div class="flex-column ml-3">
                <a href="{{route('books.show', $article->book)}}" class="text-dark font-weight-bolder">{{$article->book->title}}</a>
                <hr class="mt-1 mb-0">
                <p class="small mb-0">@foreach($article->book->authors as $author) {{ $author->name }} @continue($loop->last), @endforeach</p>
                <hr class="mt-1 mb-0">
                <p class="small">{{ $article->book->publisher }}</p>
            </div>
        </div>
        <hr class="my-0">
        <div class="row">
            <div class="col-md-12">
                <br>
                {!! $article->description !!}
            </div>
        </div>

        <hr>
        <!-- Comments Section -->
        <form action="{{route('comments.store')}}"></form>
    </div>

@endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
        @forelse($books as $book)
        <div class="col-md-3 col-sm-12 mb-5">
            <div class="card">
                <img class="" src="{{ $book->image ?? asset('images/No_Image_Available.jpg') }}" width="100%" alt="Book image">
                <div class="card-body text-center">
                    <a href="{{route('books.show', $book)}}" class="text-decoration-none"><h5 class="card-title">{{ $book->title }}</h5></a>
                    <p class="card-text">
                        @forelse($book->authors as $author)
                            {{$author->name}}
                        @empty
                            Author N/A
                        @endforelse
                    </p>

                </div>
            </div>
        </div>
        @empty
            <div class="card">
                <div class="card-body">
                    <h5 class="text-center">No Records Found.</h5>
                </div>
            </div>
        @endforelse
        </div>
        <hr>
        <a href="{{ route('books.create') }}" class="btn btn-success">Create New</a>
        <div class="d-flex justify-content-center">
            {{ $books->links() }}
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="container" style="width: 75%">
        @forelse($articles as $article)
        <div class="row bg-white rounded mx-auto mb-3">
            <img class="col-5 pl-0 pb-0 rounded" src="{{ $article->image ?? asset('images/No_Image_Available.jpg') }}" height="full" width="100%" alt="Book image">
            <div class="col-7 pt-2 pb-0">
                <a href="{{route('articles.show', $article)}}" class="text-decoration-none active"><h4>{{$article->title}}</h4></a>
                <p class="pt-2 mb-5">{{$article->excerpt}}</p>
                <div class="d-flex justify-content-between">
                    <p>{{$article->book->title}}</p>
                    <p>10 min</p>
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
        <br>
        <div class="d-flex justify-content-between">
            <div></div>
            {{ $articles->links() }}
            <a href="{{ route('articles.create') }}" class="justify-content-end btn btn-success">Create New</a>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Authors</th>
                    <th>Book</th>
                    <th class="text-center">Operations</th>
                </tr>
            </thead>
            @forelse($authors as $author)
                <tr>
                    <td>{{$loop->index + 1}}</td>
                    <td>{{$author->name}}</td>
                    <td>{{$author->book->title}}</td>
                    <td class="d-flex justify-content-center">
                        <a href="{{route('authors.edit', $author)}}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{route('authors.destroy', $author)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger ml-1">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">No Records Found.</td>
                </tr>
            @endforelse
        </table>
        <div class="d-flex justify-content-center">
            {{ $authors->links() }}
        </div>
    </div>
@endsection

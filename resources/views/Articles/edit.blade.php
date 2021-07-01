@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-12 offset-md-2">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center">
                            <h4 class="font-weight-bolder">Edit Article</h4>
                        </div>
                        <form action="{{ route('articles.update', $article) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror" value="{{old('title') ?? $article->title}}" required>
                                @error('title') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="excerpt">Excerpt</label>
                                <input type="text" name="excerpt" id="excerpt" class="form-control @error('excerpt') is-invalid @enderror" value="{{old('excerpt') ??  $article->excerpt}}" required>
                                @error('excerpt') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea type="text" name="description" rows="6" id="description" class="form-control editor @error('description') is-invalid @enderror" required>{!! old('description') ?? $article->description !!}</textarea>
                                @error('description') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
{{--                            TODO: Add Excerpt field--}}

                            <div class="form-group">
                                <button type="submit" class="btn btn-success mr-1">Update</button>
                                <a href="{{route('books.index')}}" class="btn btn-warning">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function (){
            $(".custom-file-input").on("change", function() {
                var fileName = $(this).val().split("\\").pop();
                $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
            });
        });
    </script>
    <script>
        CKEDITOR.replace('description')
    </script>
@endsection

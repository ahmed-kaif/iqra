@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-12 offset-md-2">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center">
                            <h4 class="font-weight-bolder">Create New Article</h4>
                        </div>
                        <form action="{{ route('articles.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror" value="{{old('title')}}" required>
                                @error('title') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="book">Book</label>
                                <select name="book" id="book" class="form-control">
                                    <option value="">Please Select...</option>
                                    @foreach($books as $book)
                                        <option value="{{ $book->id }}">{{ $book->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="excerpt">Short Description</label>
                                <input type="text" id="excerpt" name="excerpt" class="form-control @error('excerpt') is-invalid @enderror" value="{{old('excerpt')}}" required>
                                @error('excerpt') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea type="text" name="description" rows="6" id="description" class="form-control editor @error('description') is-invalid @enderror" required>{!! old('description') !!}</textarea>
                                @error('description') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input @error('image') is-invalid @enderror" id="image" name="image">
                                    <label class="custom-file-label" for="image">Choose Cover Image</label>
                                    @error('image') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success mr-1">Create</button>
                                <a href="{{route('articles.index')}}" class="btn btn-warning">Cancel</a>
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
        CKEDITOR.replace('description');
    </script>
@endsection

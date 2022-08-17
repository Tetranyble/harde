@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Create new Book') }}</div>

                    <div class="card-body">
                        <div class="grid grid-cols-1 md:grid-cols-2">
                            @if($errors->any())
                                {!! implode('', $errors->all('<div>:message</div>')) !!}
                            @endif
                            <form action="{{ route('books.store') }}" method="post">
                                @csrf
                                <div class="">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Book name</label>
                                        <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="name" placeholder="enter book name">
                                    </div>
                                    <div class="mb-3">
                                        <label for="isbn" class="form-label">ISBN</label>
                                        <input type="text" name="isbn" value="{{ old('isbn') }}" class="form-control" id="isbn" placeholder="enter book isbn">
                                    </div>
                                    <div class="mb-3">
                                        <label for="country" class="form-label">country</label>
                                        <input type="text" value="{{ old('country') }}" name="country" class="form-control" id="country" placeholder="enter book country">
                                    </div>
                                    <div class="mb-3">
                                        <label for="number_of_pages" class="form-label">Number of pages</label>
                                        <input type="text" value="{{ old('number_of_pages') }}" name="number_of_pages" class="form-control" id="number_of_pages" placeholder="number of pages">
                                    </div>
                                    <div class="mb-3">
                                        <label for="publisher" class="form-label">Publisher</label>
                                        <input type="text" value="{{ old('publisher') }}" name="publisher" class="form-control" id="publisher" placeholder="enter book publisher">
                                    </div>
                                    <div class="mb-3">
                                        <label for="release_date" class="form-label">Release Date</label>
                                        <input type="date" value="{{ old('release_date') }}" name="release_date" class="form-control" id="release_date" placeholder="enter book release date">
                                    </div>
                                    <div class="mb-3">
                                        <label for="authors" class="form-label">Author</label>
                                        <input type="text" value="{{ old('authors') }}" name="authors[]" class="form-control" id="author" placeholder="enter book author">
                                    </div>
                                    <div class="mb-3">
                                        <label for="authors" class="form-label">Author</label>
                                        <input type="text" value="{{ old('authors') }}" name="authors[]" class="form-control" id="author" placeholder="enter book author">
                                    </div>
                                </div>
                                <button class="btn btn-outline-primary">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

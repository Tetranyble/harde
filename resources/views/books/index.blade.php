@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Create new Book') }}</div>

                    <div class="card-body">
                        <div class="grid grid-cols-1 md:grid-cols-2">
                            <x-message></x-message>
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">ISBN</th>
                                        <th scope="col">Authors</th>
                                        <th scope="col">Pages</th>
                                        <th scope="col">Publisher</th>
                                        <th scope="col">Country</th>
                                        <th scope="col">Release Date</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($books as $book)
                                    <tr>
                                        <th scope="row">{{$book->id}}</th>
                                        <td>{{ $book->name }}</td>
                                        <td>{{ $book->isbn }}</td>
                                        <td>{{ $book->authors->pluck('name') }}</td>
                                        <td>{{ $book->number_of_pages }}</td>
                                        <td>{{ $book->publisher }}</td>
                                        <td>{{ $book->country }}</td>
                                        <td>{{ $book->release_date }}</td>
                                        <td>
                                            <a class="btn-outline-danger btn btn-sm" href="{{ route('books.destroy', $book->id) }}"
                                               onclick="event.preventDefault();
                                                     document.getElementById('delete-book').submit();">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                </svg>
                                            </a>
                                            <form id="delete-book" action="{{ route('books.destroy', $book->id) }}" method="POST" class="d-none">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                            <a href="{{ route('books.edit', $book) }}" class="btn btn-outline-dark btn-sm">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z"/>
                                                    <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z"/>
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>
                                        @empty
                                        <p>There's no book yet in the database</p>
                                    @endforelse

                                    </tbody>
                                </table>
                            {{ $books->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

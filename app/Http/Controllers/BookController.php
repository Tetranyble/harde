<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Http\Resources\BookCollection;
use App\Http\Resources\BookResource;
use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function Symfony\Component\Routing\Loader\Configurator\collection;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::with('authors')->paginate(10);
        return view('books.index', compact('books'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookRequest $request)
    {

        $book = DB::transaction(function () use($request){
            $book = Book::create($request->except('authors'));

            collect($request->authors)->map(function($author) use($book){
                return Author::create(['name' => $author, 'book_id' => $book->id]);
            });
            return $book;
        });

       //return new BookResource(Book::whereId($book->id)->first());
        return response()->json([
            'status_code' => 201,
            'status' => 'success',
            'data' => [
                'book' => new BookResource(Book::whereId($book->id)->first())
            ]
        ], 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return new BookResource($book);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        return view('books.update', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(BookRequest $request, Book $book)
    {

        DB::transaction(function () use($request , $book){
            $book->update($request->except('authors'));
            collect($request->authors)->map(function($author) use($book){
                //dd($book->authors()->where('book_id',$book->id)->first());
                return $book->authors()->where('book_id',$book->id)->first()->update(['name' => $author]);
            });
        });

        return redirect()->route('books.index')->with('success', "The book {$book->fresh()->name} was updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('books.index')->with('success', "The book My First Book was deleted successfully");
    }
}

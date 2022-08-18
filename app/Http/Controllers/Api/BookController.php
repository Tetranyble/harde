<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookRequest;
use App\Http\Resources\BookCollection;
use App\Http\Resources\BookResource;
use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return BookCollection
     */
    public function index()
    {
        return new BookCollection(Book::with('authors')->paginate(3));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BookRequest $request
     * @return BookResource
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

        //return new BookResource(Book::whereId($book->id)->first(), 201);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new BookResource(Book::whereId($id)->first());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param BookRequest $request
     * @param int $id
     * @return BookResource
     */
    public function update(BookRequest $request, $id)
    {
        $book = Book::whereId($id)->first();
        DB::transaction(function () use($request , $book){
            $book->update($request->except('authors'));
            collect($request->authors)->map(function($author) use($book){
                //dd($book->authors()->where('book_id',$book->id)->first());
                return $book->authors()->where('book_id',$book->id)->first()->update(['name' => $author]);
            });
        });
        return new BookResource(Book::whereId($book->id)->first(), 200, "The book My First Book was updated successfully");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::whereId($id)->first()->delete();
        //return new BookResource([], 204, "The book My First Book was deleted successfully");
        return response()->json([
            'status_code' => 200,
            'status' => 'success',
            'message' => 'The book My First Book was deleted successfully',
            'data' => [

            ]
        ], 200);
    }
}

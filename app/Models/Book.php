<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'isbn', 'country', 'number_of_pages', 'publisher', 'release_date'];

    public function authors(){
        return $this->hasMany(Author::class, 'book_id');
    }

    public function scopeFilter($query, $request){
        $query->where();
    }

    public function path(){
        return "/api/v1/books/{$this->id}";
    }
}

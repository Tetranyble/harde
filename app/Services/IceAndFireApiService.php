<?php


namespace App\Services;


use App\Http\Clients\IceAndFireClient;
use GuzzleHttp\Client;
use Illuminate\Support\Collection;

class IceAndFireApiService
{

    /**
     * @var IceAndFireClient
     */
    private $client;

    public function __construct(IceAndFireClient $client)
    {
        $this->client = $client;
    }

    public function books($name = ''): Collection {
        $response = $this->client->get("books?name={$name}")->getBody();

        $books = json_decode((string) $response, true);

        $collection = collect($books)->map(function ($book){
            return [
              'name' => $book['name'],
              'isbn' => $book['isbn'],
              'authors' => $book['authors'],
              'number_of_pages' => $book['numberOfPages'],
              'publisher' => $book['publisher'],
              'country' => $book['country'],
              'release_date' => $book['released'],
            ];
        });
        return $collection;
    }
}

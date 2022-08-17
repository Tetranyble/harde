<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    public $statusCode;
    public $message;

    public function __construct($resource, $statusCode = 200, $message = null)
    {
        parent::__construct($resource);
        $this->statusCode = $statusCode;
        $this->message =  $message;
    }
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'authors' => $this->authors->pluck('name'),
            'release_date' => $this->release_date,
            'number_of_pages' => $this->number_of_pages,
            'isbn' => $this->isbn,
            'country' => $this->country,
            'publisher' => $this->publisher
        ];
    }

    public function with($request)
    {
        return [
            'status' => 'success',
            'status_code' => $this->statusCode,
            'message' => $this->when($this->message, $this->message)
        ];
    }
}

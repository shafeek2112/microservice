<?php

namespace App\Services;

use App\Traits\ConsumesExternalServices;

class BookService {

    use ConsumesExternalServices;

    /* 
    *   Base url to consume book service
    */
    public $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.books.base_uri');
    }

    /** 
    *   Get list of books from Book micro service.
    *   @return string
    */
    public function obtainBooks()
    {
        return $this->performRequest('GET', '/books');
    }
    
    
    /** 
    *   Create a new book using book service.
    *   @param array book form data
    *   @return string
    */
    public function createBook($data)
    {
        return $this->performRequest('POST', '/books', $data);
    }
    
    /** 
    *   Get a specific book from the book service
    *   @param integer book id
    *   @return string
    */
    public function obtainBook($book)
    {
        return $this->performRequest('GET', "/books/{$book}");
    }
    
    /** 
    *   Edit a specific book 
    *   @param integer book id
    *   @param array book form data
    *   @return string
    */
    public function updateBook($data, $book)
    {
        return $this->performRequest('PUT', "/books/{$book}", $data);
    }
    
    /** 
    *   Delete a specific book from book service 
    *   @param integer book id
    *   @return string
    */
    public function deleteBook($book)
    {
        return $this->performRequest('DELETE', "/books/{$book}");
    }
    
}
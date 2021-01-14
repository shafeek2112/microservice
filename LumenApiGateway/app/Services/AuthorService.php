<?php

namespace App\Services;

use App\Traits\ConsumesExternalServices;

class AuthorService {

    use ConsumesExternalServices;

    /* 
    *   Base url to consume Author service
    */
    public $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.authors.base_uri');
    }

    /** 
    *   Get list of authors from Author micro service.
    *   @return string
    */
    public function obtainAuthors()
    {
        return $this->performRequest('GET', '/authors');
    }
    
    
    /** 
    *   Create a new author using author service.
    *   @param array author form data
    *   @return string
    */
    public function createAuthor($data)
    {
        return $this->performRequest('POST', '/authors', $data);
    }
    
    /** 
    *   Get a specific author from the author service
    *   @param integer author id
    *   @return string
    */
    public function obtainAuthor($author)
    {
        return $this->performRequest('GET', "/authors/{$author}");
    }
    
    /** 
    *   Edit a specific author 
    *   @param integer author id
    *   @param array author form data
    *   @return string
    */
    public function updateAuthor($data, $author)
    {
        return $this->performRequest('PUT', "/authors/{$author}", $data);
    }
    
    /** 
    *   Delete a specific author from author service 
    *   @param integer author id
    *   @return string
    */
    public function deleteAuthor($author)
    {
        return $this->performRequest('DELETE', "/authors/{$author}");
    }
}
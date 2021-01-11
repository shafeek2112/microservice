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
}
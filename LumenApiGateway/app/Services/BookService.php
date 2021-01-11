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
        $this->baseUri = config('services.book.base_uri');
    }

    
}
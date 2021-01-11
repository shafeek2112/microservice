<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;
use App\Author;
use App\Services\AuthorService;

class AuthorController extends Controller
{
    use ApiResponser;

    /* 
    *   Service to consume the author microservice
    */
    public $authorService;

    /**
     * Create a new controller instance.
     *
     * @return void
    */
    public function __construct(AuthorService $authorService)
    {
        $this->authorService = $authorService;
    }

    /**
    *   Return the list of author
    *   @return Illuminate\Http\Response
    */
    public function index()
    {
        return $this->successResponse($this->authorService->obtainAuthors());
    }
    
    /**
    *   Store a new author
    *   @return Illuminate\Http\Response
    */
    public function store(Request $request)
    {
       
    }

    /**
    *   Obtain and show one author
    *   @return Illuminate\Http\Response
    */
    public function show($author)
    {
       
    }
   
    /**
    *   Update an exiting author
    *   @return Illuminate\Http\Response
    */
    public function update(Request $request, $author)
    {
        
    }

    /**
    *   Remove author
    *   @return Illuminate\Http\Response
    */
    public function destroy($author)
    {
       
    }
}

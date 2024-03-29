<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;
use App\Models\Book;
use App\Services\BookService;

class BookController extends Controller
{
    use ApiResponser;

    /* 
    *   Service to consume the book microservice
    */
    public $bookService;

    /**
     * Create a new controller instance.
     *
     * @return void
    */
    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }

    /**
    *   Return the list of book
    *   @return Illuminate\Http\Response
    */
    public function index()
    {
        return $this->successResponse($this->bookService->obtainBooks());
    }
    
    /**
    *   Store a new book
    *   @return Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        return $this->successResponse($this->bookService->createBook($request->all(), Response::HTTP_CREATED));
    }

    /**
    *   Obtain and show one book
    *   @return Illuminate\Http\Response
    */
    public function show($book)
    {
        return $this->successResponse($this->bookService->obtainBook($book));
    }
   
    /**
    *   Update an exiting book
    *   @return Illuminate\Http\Response
    */
    public function update(Request $request, $book)
    {
        return $this->successResponse($this->bookService->updateBook($request->all(), $book));
    }

    /**
    *   Remove book
    *   @return Illuminate\Http\Response
    */
    public function destroy($book)
    {
        return $this->successResponse($this->bookService->deleteBook($book));
    }
}

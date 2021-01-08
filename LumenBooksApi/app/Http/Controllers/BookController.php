<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;
use App\Models\Book;

class BookController extends Controller
{
    use ApiResponser;

    /**
     * Create a new controller instance.
     *
     * @return void
    */
    public function __construct()
    {
        //
    }

    /**
    *   Return the list of book
    *   @return Illuminate\Http\Response
    */
    public function index()
    {
        $books = Book::all();
        return $this->successResponse($books);
    }
    
    /**
    *   Store a new book
    *   @return Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        $rules = [
            'title'         => 'required|max:255',
            'description'   => 'required|max:255',
            'price'         => 'required|min:1',
            'author_id'     => 'required|min:1',
        ];

        $this->validate($request, $rules);

        $book = Book::create($request->all());
        return $this->successResponse($book);
    }

    /**
    *   Obtain and show one book
    *   @return Illuminate\Http\Response
    */
    public function show($book)
    {
       $book = Book::findOrFail($book);
       return $this->successResponse($book);
    }
   
    /**
    *   Update an exiting book
    *   @return Illuminate\Http\Response
    */
    public function update(Request $request, $book)
    {
        $rules = [
            'title'         => 'required|max:255',
            'description'   => 'required|max:255',
            'price'         => 'required|min:1',
            'author_id'     => 'required|min:1',
        ];
        
        $this->validate($request, $rules);

        $book = Book::findOrFail($book);
        $book->fill($request->all());

        ## Check if anything changed in the request.
        if($book->isClean())
        {
            return $this->errorResponse('Atleast one value must be changed',Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $book->save();
        return $this->successResponse($book);
    }

    /**
    *   Remove book
    *   @return Illuminate\Http\Response
    */
    public function destroy($book)
    {
        $book = Book::findOrFail($book);
        $book->delete();

        return $this->successResponse($book);
    }
}

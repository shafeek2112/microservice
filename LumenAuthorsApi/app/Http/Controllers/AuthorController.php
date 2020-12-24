<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;
use App\Author;

class AuthorController extends Controller
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
    *   Return the list of author
    *   @return Illuminate\Http\Response
    */
    public function index()
    {
        $authors = Author::all();
        return $this->successResponse($authors);
    }
    
    /**
    *   Store a new author
    *   @return Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        $rules = [
            'name'      => 'required|max:255',
            'gender'    => 'required|max:255|in:male,female',
            'country'   => 'required|max:255',
        ];

        $this->validate($request, $rules);

        $author = Author::create($request->all());
        return $this->successResponse($author);
    }

    /**
    *   Obtain and show one author
    *   @return Illuminate\Http\Response
    */
    public function show($author)
    {
       $author = Author::findOrFail($author);
       return $this->successResponse($author);
    }
   
    /**
    *   Update an exiting author
    *   @return Illuminate\Http\Response
    */
    public function update(Request $request, $author)
    {
        $rules = [
            'name'      => 'max:255',
            'gender'    => 'max:255|in:male,female',
            'country'   => 'max:255',
        ];

        $this->validate($request, $rules);

        $author = Author::findOrFail($author);
        $author->fill($request->all());

        ## Check if anything changed in the request.
        if($author->isClean())
        {
            return $this->errorResponse('Atleast one value must be changed',Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $author->save();
        return $this->successResponse($author);
    }

    /**
    *   Remove author
    *   @return Illuminate\Http\Response
    */
    public function destroy($author)
    {
        $author = Author::findOrFail($author);
        $author->delete();

        return $this->successResponse($author);
    }
}

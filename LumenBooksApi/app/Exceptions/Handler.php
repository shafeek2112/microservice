<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;

class Handler extends ExceptionHandler
{
    use ApiResponser;

    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
       ## http exception
       if($exception instanceof HttpException) 
       {
           $code = $exception->getStatusCode();
           $message = Response::$statusTexts[$code];
           return $this->errorResponse($message, $code);
       }
      
       ## Model not found exception
       if($exception instanceof ModelNotFoundException) 
       {
           $model = strtolower(class_basename($exception->getModel()));
           $message = "Does not exist any instance of {$model} with the given id";
           return $this->errorResponse($message, Response::HTTP_NOT_FOUND);
       }

       ## Authorization exception
       if($exception instanceof AuthenticationException) 
       {
           return $this->errorResponse($exception->getMessage(), Response::HTTP_UNAUTHORIZED);
       }
       
       ## Validation exception
       if($exception instanceof ValidationException) 
       {
           $errors = $exception->validator->errors()->getMessages();
           return $this->errorResponse($errors, Response::HTTP_UNPROCESSABLE_ENTITY);
       }

       ## If above noting fall and in production mode just return default exception
       if(env('APP_DEBUG',false))
       {
           return parent::render($request, $exception);
       }

       return $this->errorResponse('Unexpected error. Try again.',Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}

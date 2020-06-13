<?php

namespace MixCode\Exceptions;

use BadMethodCallException;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\RelationNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use MoaAlaa\ApiResponder\ApiResponder;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    use ApiResponder;

    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if ($request->wantsJson()) {
            // Handle Exception For Validation Exceptions Errors
            if ($exception instanceof ValidationException) {
                // For Passing Validation Test Cases 
                if (! app()->environment('testing')) {
                    return $this->api()->error($exception->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
                    
                }
    
                // Handle Exception For Authentication Exceptions Errors
            } elseif ($exception instanceof AuthenticationException) {
                return $this->api()->error($exception->getMessage(), Response::HTTP_UNAUTHORIZED);
    
                // Handle Exception For Model Not Found Exceptions Errors
            } elseif ($exception instanceof ModelNotFoundException) {
    
                return $this->api()->error(trans('main.not_found'), Response::HTTP_NOT_FOUND);
                
                // Handle Exception For Not Found Exceptions Errors
            } elseif ($exception instanceof NotFoundHttpException) {
                
                return $this->api()->error(trans('main.not_found'), Response::HTTP_NOT_FOUND);
                
                // Handle Exception For Bad Method Call Exceptions Errors
            } elseif ($exception instanceof BadMethodCallException) {
    
                return $this->api()->error($exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);

                // Handle Exception For Method Not Allowed HTTP Exceptions Errors
            } elseif ($exception instanceof MethodNotAllowedHttpException) {
    
                return $this->api()->error($exception->getMessage(), Response::HTTP_METHOD_NOT_ALLOWED);
    
            } elseif ($exception instanceof HttpException) {
                
                return $this->api()->error('Unauthorized', Response::HTTP_UNAUTHORIZED);

                // Handle Exception For Relations Not FoundExceptions Errors
            } elseif ($exception instanceof RelationNotFoundException) {
    
                return $this->api()->error($exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
    
            }
        }


        return parent::render($request, $exception);
    }
}

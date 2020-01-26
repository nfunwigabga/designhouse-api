<?php

namespace App\Exceptions;

use Exception;
use App\Exceptions\ModelNotDefined;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
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
        if($exception instanceof AuthorizationException){
            if($request->expectsJson()){
                return response()->json(["errors" => [
                    "message" => "You are not authorized to access this resource"
                ]], 403);
            }
        }

        if($exception instanceof ModelNotFoundException && $request->expectsJson()){
            return response()->json(["errors" => [
                "message" => "The resource was not found in the database"
            ]], 404);
        }

        if($exception instanceof ModelNotDefined && $request->expectsJson()){
            return response()->json(["errors" => [
                "message" => "No model defined"
            ]], 500);
        }

        


        return parent::render($request, $exception);
    }
}

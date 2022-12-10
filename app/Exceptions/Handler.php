<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $e)
    {
        $class_base_name_exception = class_basename($e);
//        dd($class_base_name_exception);

        # set message
        $message = $e->getMessage();
//        $app_env = env('APP_ENV') ?? 'production';
//        $app_env = 'production';
        $app_env = 'local';

        if ($app_env === 'production') {
            $message = persianString($message) ? $message : '';
        }

        if ($e instanceof ModelNotFoundException) {
            return response_not_found(message: $message);
        }
        elseif ($e instanceof ValidationException){
            $status_code = \Symfony\Component\HttpFoundation\Response::HTTP_UNPROCESSABLE_ENTITY;
            $errors = method_exists($e, 'errors') ? $e->errors() : [];
            return response_validation_exception(message: $message, status: $status_code, errors: $errors);
        }

        return response_catch(message: $message);

//          return parent::render($request, $e); // TODO: Change the autogenerated stub
    }

}

<?php

namespace App\Exceptions;

use App\Helper\Response;
use App\Http\Controllers\Controller;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

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
    public function report(Throwable $exception)
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
    public function render($request, Throwable $exception)
    {
        return parent::render($request, $exception);
    }

    public function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            $result['message'] = "Please login to continue";
            $result['messageId'] = "Silakan masuk untuk melanjutkan";
            return Response::jsonErrorSimple(
                Controller::UNAUTHORIZE,
                Controller::USER_UNAUTHORIZE,
                $result['message'],
                $result['messageId']
            );
        }
        $result['message'] = "Please login to continue";
        $result['messageId'] = "Silakan masuk untuk melanjutkan";
        return Response::jsonErrorSimple(
            Controller::UNAUTHORIZE,
            Controller::USER_UNAUTHORIZE,
            $result['message'],
            $result['messageId']
        );
    }
}

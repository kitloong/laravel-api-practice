<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Kevincobain2000\LaravelAlertNotifications\Dispatcher\AlertDispatcher;
use Throwable;

class Handler extends ExceptionHandler
{
    private $exceptionLogLevels = [
        //
    ];

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
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        try {
            $dontReport = array_merge($this->dontReport, $this->internalDontReport);
            $alertDispatcher = new AlertDispatcher($exception, $dontReport, $this->exceptionLogLevels);
            $alertDispatcher->notify();
        } catch (Throwable $e) {
            // log any unexpected exceptions or do nothing
        }

        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        return parent::render($request, $exception);
    }
}

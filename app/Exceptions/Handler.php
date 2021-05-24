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
            try {
                $dontReport = array_merge($this->dontReport, $this->internalDontReport);
                $alertDispatcher = new AlertDispatcher($e, $dontReport, $this->exceptionLogLevels);
                $alertDispatcher->notify();
            } catch (Throwable $e) {
                // log any unexpected exceptions or do nothing
            }
        });
    }
}

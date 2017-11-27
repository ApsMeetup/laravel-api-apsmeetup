<?php

namespace APSMeetup\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use \Illuminate\Database\Eloquent\ModelNotFoundException;
use \Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Http\Response;
use \Illuminate\Validation\ValidationException;
use \Symfony\Component\Routing\Exception\MethodNotAllowedException;

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
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
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
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if ($exception instanceof ModelNotFoundException) {
            return response()->json([
                'data' => ['message' => 'Record not found']
            ], Response::HTTP_NOT_FOUND);
        }

        if ($exception instanceof NotFoundHttpException) {
            return response()->json([
                'data' => ['message' => 'URI not found']
            ], Response::HTTP_NOT_FOUND);
        }

        if ($exception instanceof ValidationException) {
            return response()->json([
                'data' => ['message' => $exception->getMessage(),
                'errors' => $exception->errors()]
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        if ($exception instanceof MethodNotAllowedException) {
            return response()->json([
                'data' => ['message' => 'Method not allowed']
            ], Response::HTTP_METHOD_NOT_ALLOWED);
        }

        return parent::render($request, $exception);
    }
}

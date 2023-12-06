<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
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
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
        
        $this->renderable(function (\Exception $e, Request $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'error' => $e->getMessage()
                ], $e->getCode());
            }
        });
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Exception $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Exception
     */
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof Exception && $request->is('api/*') && $request->wantsJson()) {
            return response()->json([
                'error' => $exception->getMessage()
            ], ($exception->getCode() == 0) ? 404 : $exception->getCode());
        }

        return parent::render($request, $exception);
    }


    // /**
    //  * Render an exception into an HTTP response.
    //  *
    //  * @param \Illuminate\Http\Request $request
    //  * @param \Exception $exception
    //  * @return \Symfony\Component\HttpFoundation\Response
    //  *
    //  * @throws \Exception
    //  */
    // public function render($request, Exception $exception)
    // {
    //     // This will replace our 404 response with
    //     // a JSON response.
    //     if ($exception instanceof ModelNotFoundException && $request->wantsJson()) {
    //         return response()->json([
    //             'data' => 'Resource not found'
    //         ], 404);
    //     }

    //     return parent::render($request, $exception);
    // }
}

<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * @param Request $request
     * @param Throwable $exception
     * @return Application|ResponseFactory|JsonResponse|Response|\Symfony\Component\HttpFoundation\Response
     * @throws Throwable
     */
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof MethodNotAllowedHttpException) {
            $result = ['errors' => ['method' => [__('Method :method not allowed', ['method' => $request->getMethod()])]]];

            return response($result, Response::HTTP_METHOD_NOT_ALLOWED);
        }

        if ($exception instanceof NotFoundHttpException) {
            $result = ['errors' => ['route' => [__('Route not found')]]];

            return response($result, Response::HTTP_NOT_FOUND);
        }

        if ($exception instanceof ModelNotFoundException) {
            $result = ['errors' => ['error' => [__('Model not found')]]];

            if (config('app.debug')) {
                $result['errors']['message'] = $exception->getMessage();
                $result['errors']['model'] = $exception->getModel();
            }

            return response($result, Response::HTTP_NOT_FOUND);
        }

        if ($exception instanceof ValidationException) {
            return response(['errors' => $exception->errors()], Response::HTTP_BAD_REQUEST);
        }

        if ($exception instanceof Exception) {
            $result = [
                'errors' => [
                    'message' => $exception instanceof QueryException ? [__('Invalid query params')] : [$exception->getMessage()],
                ],
            ];

            if (config('app.debug')) {
                $result = [
                    'errors' => [
                        'message' => [$exception->getMessage()],
                        'exception' => get_class($exception),
                        'file' => $exception->getFile(),
                        'line' => $exception->getLine(),
                        'trace' => $exception->getTrace(),
                    ],
                ];
            }

            return response($result, Response::HTTP_BAD_REQUEST);
        }

        return parent::render($request, $exception);
    }

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
}

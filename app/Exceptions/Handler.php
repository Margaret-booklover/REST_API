<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
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
        ValidateException::class,
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
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Output validation exceptions from Form Requests as json.
     *
     * @param ValidationException $e
     * @param Request $request
     * @return Response
     */
    protected function convertValidationExceptionToResponse(ValidationException $e, $request)
    {
        if ($e->response) {
            return $e->response;
        }

        $errors = collect($e->validator->errors()->toArray())
            ->flatten()
            ->map(function (string $message) {
                return [
                    "code" => "ValidationError",
                    "message" => $message,
                ];
            })
            ->values()
            ->toArray();

        return response()->json($this->formatErrorPayload($errors), 400);
    }
    protected function getExceptionStatusCode(Throwable $exception): int
    {
        if ($exception instanceof HttpExceptionInterface) {
            return $exception->getStatusCode();
        }

        if ($exception instanceof ModelNotFoundException) {
            return 404;
        }

        return 500;
    }

    private function formatErrorPayload(array $errorData): array
    {
        return [
            'data' => null,
            'errors' => $errorData,
        ];
    }

}

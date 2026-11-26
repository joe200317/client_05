<?php

namespace App\Http\Middleware;

use App\Support\FormIdempotency;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class PreventDuplicateSubmission
{
    /**
     * @param  Closure(Request): Response  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! in_array($request->method(), ['POST', 'PUT', 'PATCH'], true)) {
            return $next($request);
        }

        $scope = $request->route()?->getName();

        if (! FormIdempotency::claim($request, $scope)) {
            return $this->duplicateResponse($request);
        }

        try {
            return $next($request);
        } catch (ValidationException $exception) {
            FormIdempotency::release($request, $scope);

            throw $exception;
        } catch (Throwable $exception) {
            FormIdempotency::release($request, $scope);

            throw $exception;
        }
    }

    private function duplicateResponse(Request $request): Response
    {
        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Your request was already received. Please wait a moment.',
                'duplicate' => true,
            ], 200);
        }

        $redirect = redirect()->back(fallback: url('/'));

        if (! $request->session()->has('status')) {
            $redirect->with('status', 'Your request was already received. Please wait a moment before trying again.');
        }

        return $redirect;
    }
}

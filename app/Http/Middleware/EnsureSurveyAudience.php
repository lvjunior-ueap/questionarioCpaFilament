<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureSurveyAudience
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user && ! $user->is_admin && $user->audience?->value !== $request->route('audience')) {
            return redirect()->route('survey.show', ['audience' => $user->audience->value]);
        }

        return $next($request);
    }
}

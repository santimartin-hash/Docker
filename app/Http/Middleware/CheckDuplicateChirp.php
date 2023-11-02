<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Chirp;

class CheckDuplicateChirp extends Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
{
    $chirp = $request->input('message');

    $duplicate = Chirp::where('message', $chirp)->first();

    if ($duplicate) {
        // Redirige o maneja el error como prefieras
        return redirect()->back()->withErrors(['chirp' => 'El chirp ya existe']);
    }

    return $next($request);
}
}

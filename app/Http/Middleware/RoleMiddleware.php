<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth; // <-- 1. Importamos el Facade Auth oficial
use App\Models\Usuario;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // 2. Usamos Auth::check() en lugar de auth()->check()
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // 3. Usamos Auth::user() para obtener el usuario actual
        /** @var Usuario $usuario */
        $usuario = Auth::user();

        // 4. Verificamos si tiene el rol
        if (!$usuario->hasRole($roles)) {
            abort(403, 'No tienes permisos para acceder a este módulo.');
        }

        return $next($request);
    }
}
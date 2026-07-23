<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class RoleMiddleware{
    public function handle(Request $request, Closure $next, string $role){
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $userRole = Auth::user()->role;
        if ($userRole !== $role) {
            if ($userRole === 'admin') {
                return redirect()->route('admin.dashboard');
            }
            return redirect()->route('students.dashboard');
        }
        return $next($request);
    }
}



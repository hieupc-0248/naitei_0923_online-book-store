<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Role;

class AdminCheck
{
    public function handle(Request $request, Closure $next)
    {
        $adminRole = Role::where('name', 'admin')->first()->id;

        if ($adminRole && auth()->check() && auth()->user()->role_id == $adminRole) {
            return $next($request);
        }

        abort(403, __('Unauthorized'));
    }
}

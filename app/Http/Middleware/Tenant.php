<?php
namespace App\Http\Middleware;

use App\Login;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;

class Tenant
{
    public function handle(Request $request, \Closure $next)
    {
        try {
            if (!$request->hasHeader('Tenant')) {
                throw new \Exception();
            }

            $tenant = $request->header('Tenant');
            
            config(['database.connections.tenant.database' => $tenant]);
            config(['database.connections.tenant.username' => $tenant]);

            return $next($request);
        } catch (\Exception $e) {
            return response()->json('Tenant not found', 401);
        }
    }
}
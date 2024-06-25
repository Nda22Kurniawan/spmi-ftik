<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Jenjang;
use App\Prodi;

class FetchJenjangProdi
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next)
    {
        $jenjangs = Jenjang::all();
        $prodis = Prodi::all();

        // Attach to the request
        $request->merge(compact('jenjangs', 'prodis'));

        return $next($request);
    }
}

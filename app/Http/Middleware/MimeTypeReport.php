<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MimeTypeReport
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $mimePdf = 'application/pdf';
        $mimeExcel = 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';

        $accept = $request->header('Accept');

        $isPdf = $mimePdf === $accept;
        $isExcel = $mimeExcel === $accept;

        $request->headers->set('Is-Pdf', $isPdf);
        $request->headers->set('Is-Excel', $isExcel);

        return $next($request);
    }
}

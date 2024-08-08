<?php

use Illuminate\Http\Request;
use App\Http\Middleware\IsAdmin;
use Illuminate\Foundation\Application;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use \Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
            'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
            'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
            'check.alumni.profile' => \App\Http\Middleware\CheckAlumniProfile::class,
            'track.job.view' => \App\Http\Middleware\TrackJobView::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->respond(function (Response $response) {
            if ($response->getStatusCode() === 503) {
                return response()->view('errors.503');
            }
            // if ($response->getStatusCode() === 500) {
            //     return response()->view('errors.500');
            // }
            if ($response->getStatusCode() === 404) {
                return response()->view('errors.404');
            }
            if ($response->getStatusCode() === 403) {
                return response()->view('errors.403');
            }
            if ($response->getStatusCode() === 400) {
                return response()->view('errors.400');
            }
            return $response;
        });
    })->create();
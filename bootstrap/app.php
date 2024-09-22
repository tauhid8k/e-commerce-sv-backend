<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Validation\ValidationException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->validateCsrfTokens(
            except: ['api/*', 'telescope/*']
        );

        $middleware->statefulApi();

        $middleware->alias([
            'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
            'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
            'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {

        // Custom Validation Error
        $exceptions->render(function (ValidationException $e) {
            $errors = [];

            foreach ($e->errors() as $field => $messages) {
                $errors[] = [
                    'field' => $field,
                    'message' => $messages[0]
                ];
            }

            return response()->json([
                'validationErrors' => $errors
            ], 422);
        });
    })->create();

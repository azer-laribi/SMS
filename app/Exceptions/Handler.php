<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\AuthenticationException;

class Handler extends ExceptionHandler
{

    protected $dontReport = [
        //
    ];
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }
        if ($request->is('admin') || $request->is('admin/*')) {
            return redirect()->guest('/login/admin');
        }
        if ($request->is('student') || $request->is('student/*')) {
            return redirect()->guest('/login/student');
        }
        if ($request->is('teacher') || $request->is('teacher/*')) {
            return redirect()->guest('/login/teacher');
        }
        return redirect()->guest(route('login'));
    }


    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];


    public function register()
    {
        //
    }
}

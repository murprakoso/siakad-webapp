<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;

class Handler extends Exception
{
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        // return $request->expectsJson()
        //     ? response()->json(['message' => 'Unauthenticated.'], 401)
        //     : redirect()->guest(url('/')); // Atau route lainnya

        $guard = data_get($exception->guards(), 0);

        switch ($guard) {
            case 'operator':
                $login = 'operator.login';
                break;
            case 'guru':
                $login = 'guru.login';
                break;
            case 'siswa':
                $login = 'siswa.login';
                break;
            default:
                $login = 'login';
                break;
        }

        return $request->expectsJson()
            ? response()->json(['message' => $exception->getMessage()], 401)
            : redirect()->guest(route($login));
    }

}

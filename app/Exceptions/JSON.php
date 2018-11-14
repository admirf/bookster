<?php
/**
 * Created by PhpStorm.
 * User: admirf
 * Date: 11/14/18
 * Time: 7:56 PM
 */

namespace App\Exceptions;

use Illuminate\Validation\ValidationException;

trait JSON
{
    public function renderJson(\Exception $exception)
    {
        $status = 500;
        $className = get_class($exception);
        $statusCodes = config('app.codes');

        if (isset($statusCodes[$className])) {
            $status = $statusCodes[$className];
        }

        return response()->json([
            'message' => $exception->getMessage(),
            'errors' => $exception instanceof ValidationException ? $exception->errors(): 'unkown',
            'trace' => env('APP_DEBUG') ? $exception->getTrace(): 'disabled'
        ], $status);
    }
}
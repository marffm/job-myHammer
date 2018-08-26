<?php
declare(strict_types=1);

namespace App\MyHammer\Infrastructure\Helper;

class JsonResponseFormatter
{
    /**
     * @param mixed $response
     * @return array
     */
    public static function successResponse($response): array
    {
        return [
            'data' => $response,
            'status' => '200'
        ];
    }

    /**
     * @param string $message
     * @return array
     */
    public static function errorResponse(string $message): array
    {
        return [
            'error' => $message,
            'status' => 500
        ];
    }
}

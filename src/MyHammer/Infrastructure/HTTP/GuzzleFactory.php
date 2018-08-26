<?php
declare(strict_types=1);

namespace App\MyHammer\Infrastructure\HTTP;

use GuzzleHttp\Client;

class GuzzleFactory
{

    public function createClient()
    {
        return new Client();
    }
}

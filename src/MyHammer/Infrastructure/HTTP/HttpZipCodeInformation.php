<?php
declare(strict_types=1);

namespace App\MyHammer\Infrastructure\HTTP;

use App\MyHammer\Domain\Job\RepositoryInterface\HttpZipCodeInformationInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Psr\Http\Message\ResponseInterface;

class HttpZipCodeInformation implements HttpZipCodeInformationInterface
{

    private const URI = 'http://api.zippopotam.us/DE/';

    /**
     * @var Client
     */
    private $httpClient;

    public function __construct(Client $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * @param int $zipCode
     * @return array|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getGermanZipCodeInformation(int $zipCode): ?array
    {
        try {
            $response = $this->httpClient->request(
                'GET',
                static::URI . (string)$zipCode
            );
        } catch (ClientException $error) {
            $response = $error->getResponse();

            if (! $response instanceof ResponseInterface) {
                throw new \RuntimeException('Unknown error.');
            }

            $response = \json_decode($response->getBody()->getContents(), true);

            throw new \InvalidArgumentException($response['message']);
        }

        return \json_decode($response->getBody()->getContents(), true) ?? null;
    }
}

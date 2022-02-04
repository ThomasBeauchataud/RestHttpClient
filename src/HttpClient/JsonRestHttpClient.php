<?php

namespace TBCD\RestHttpClient\HttpClient;

use Symfony\Component\HttpClient\Exception\JsonException;
use Symfony\Component\HttpFoundation\Request;

class JsonRestHttpClient extends RestHttpClient implements RestHttpClientInterface
{

    /**
     * @inheritDoc
     */
    protected function run(string $method, string $url, array $parameters = [], array $headers = []): array
    {
        if ($method !== Request::METHOD_GET) {
            $headers['Content-Type'] = 'application/json';
        }

        $responseContent = parent::run($method, $url, $parameters, $headers);

        $jsonResponseContent = json_decode($responseContent, true);

        if (!$jsonResponseContent) {
            throw new JsonException("The request didn't return a valid JSON object");
        }

        return $jsonResponseContent;
    }
}
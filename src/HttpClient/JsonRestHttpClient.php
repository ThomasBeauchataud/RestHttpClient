<?php

/*
 * The file is part of the TBCD\RestHttpClient library
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Author Thomas Beauchataud
 * From 26/01/2022
 */

namespace TBCD\RestHttpClient\HttpClient;

use Symfony\Component\HttpClient\Exception\JsonException;
use Symfony\Component\HttpFoundation\Request;

class JsonRestHttpClient extends RestHttpClient implements JsonRestHttpClientInterface
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
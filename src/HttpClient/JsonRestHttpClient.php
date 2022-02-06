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

class JsonRestHttpClient extends AbstractRestHttpClient implements JsonRestHttpClientInterface
{

    /**
     * @inheritDoc
     */
    public function get(string $url, array $parameters = [], array $headers = []): array
    {
        $headers['Accept'] = 'application/json';
        return $this->run(Request::METHOD_GET, $url, $parameters, $headers);
    }

    /**
     * @inheritDoc
     */
    public function post(string $url, array $parameters = [], array $headers = []): array
    {
        $headers['Content-Type'] = 'application/json';
        $headers['Accept'] = 'application/json';
        return $this->run(Request::METHOD_POST, $url, $parameters, $headers);
    }

    /**
     * @inheritDoc
     */
    public function put(string $url, array $parameters = [], array $headers = []): array
    {
        $headers['Content-Type'] = 'application/json';
        $headers['Accept'] = 'application/json';
        return $this->run(Request::METHOD_PUT, $url, $parameters, $headers);
    }

    /**
     * @inheritDoc
     */
    public function patch(string $url, array $parameters = [], array $headers = []): array
    {
        $headers['Content-Type'] = 'application/json';
        $headers['Accept'] = 'application/json';
        return $this->run(Request::METHOD_PATCH, $url, $parameters, $headers);
    }

    /**
     * @inheritDoc
     */
    public function delete(string $url, array $parameters = [], array $headers = []): array
    {
        $headers['Content-Type'] = 'application/json';
        $headers['Accept'] = 'application/json';
        return $this->run(Request::METHOD_DELETE, $url, $parameters, $headers);
    }

    /**
     * @inheritDoc
     */
    protected function run(string $method, string $url, array $parameters = [], array $headers = []): array
    {
        $responseContent = parent::run($method, $url, $parameters, $headers);

        $jsonResponseContent = json_decode($responseContent, true);

        if (!$jsonResponseContent) {
            throw new JsonException("The request didn't return a valid JSON object");
        }

        return $jsonResponseContent;
    }
}
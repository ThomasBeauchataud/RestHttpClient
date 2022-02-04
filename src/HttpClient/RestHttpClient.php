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

use Psr\Log\LoggerInterface;
use Symfony\Component\HttpClient\Exception\InvalidArgumentException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class RestHttpClient implements RestHttpClientInterface
{

    protected HttpClientInterface $httpClient;
    protected LoggerInterface $logger;

    /**
     * @param HttpClientInterface $client
     * @param LoggerInterface $restClientLogger
     */
    public function __construct(HttpClientInterface $client, LoggerInterface $restClientLogger)
    {
        $this->httpClient = $client;
        $this->logger = $restClientLogger;
    }


    /**
     * @inheritDoc
     */
    public function get(string $url, array $parameters = [], array $headers = []): mixed
    {
        return $this->run(Request::METHOD_GET, $url, $parameters, $headers);
    }

    /**
     * @inheritDoc
     */
    public function post(string $url, array $parameters = [], array $headers = []): mixed
    {
        return $this->run(Request::METHOD_POST, $url, $parameters, $headers);
    }

    /**
     * @inheritDoc
     */
    public function put(string $url, array $parameters = [], array $headers = []): mixed
    {
        return $this->run(Request::METHOD_PUT, $url, $parameters, $headers);
    }

    /**
     * @inheritDoc
     */
    public function patch(string $url, array $parameters = [], array $headers = []): mixed
    {
        return $this->run(Request::METHOD_PUT, $url, $parameters, $headers);
    }

    /**
     * @inheritDoc
     */
    public function delete(string $url, array $parameters = [], array $headers = []): mixed
    {
        return $this->run(Request::METHOD_DELETE, $url, $parameters, $headers);
    }

    /**
     * @param string $method
     * @param string $url
     * @param array $parameters
     * @param array $headers
     * @return mixed
     * @throws ExceptionInterface
     */
    protected function run(string $method, string $url, array $parameters = [], array $headers = []): mixed
    {
        try {

            if (isset($headers['Content-Type']) && $headers['Content-Type'] === 'application/json') {
                $params = ['json' => $parameters, 'headers' => $headers];
            } elseif (isset($headers['Content-Type']) && $headers['Content-Type'] === 'application/x-www-form-urlencoded') {
                $params = ['body' => $parameters, 'headers' => $headers];
            } elseif ($method === Request::METHOD_GET) {
                $params = ['query' => $parameters, 'headers' => $headers];
            } else {
                throw new InvalidArgumentException('Unable to interpret the request');
            }

            $response = $this->httpClient->request($method, $url, $params);

            try {
                $responseContent = $response->getContent();
                $this->logger->info("Response: " . $response->getStatusCode());
                return $responseContent;
            } catch (ClientExceptionInterface $e) {
                $this->logger->critical("Response: " . $response->getStatusCode() . " - " . $response->getContent(false), $response->getInfo());
                throw $e;
            }

        } catch (ExceptionInterface $e) {
            $this->logger->critical($e->getMessage());
            throw $e;
        }
    }
}
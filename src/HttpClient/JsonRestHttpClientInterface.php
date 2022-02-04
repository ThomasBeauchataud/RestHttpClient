<?php

/*
 * The file is part of the WoWUltimate project 
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Author Thomas Beauchataud
 * From 26/01/2022
 */

namespace TBCD\RestHttpClient\HttpClient;

use Symfony\Contracts\HttpClient\Exception\ExceptionInterface;

interface JsonRestHttpClientInterface extends RestHttpClientInterface
{

    /**
     * Perform a GET request on a REST API
     * Allow only JSON response
     *
     * @param string $url
     * @param array $parameters
     * @param array $headers
     * @return array
     * @throws ExceptionInterface
     */
    public function get(string $url, array $parameters = [], array $headers = []): mixed;

    /**
     * Perform a POST request on a REST API with a JSON body
     * Allow only JSON response
     *
     * @param string $url
     * @param array $parameters
     * @param array $headers
     * @return array
     * @throws ExceptionInterface
     */
    public function post(string $url, array $parameters = [], array $headers = []): mixed;

    /**
     * Perform a PUT request on a REST API with a JSON body
     * Allow only JSON response
     *
     * @param string $url
     * @param array $parameters
     * @param array $headers
     * @return array
     * @throws ExceptionInterface
     */
    public function put(string $url, array $parameters = [], array $headers = []): mixed;

    /**
     * Perform a PATCH request on a REST API with a JSON body
     * Allow only JSON response
     *
     * @param string $url
     * @param array $parameters
     * @param array $headers
     * @return array
     * @throws ExceptionInterface
     */
    public function patch(string $url, array $parameters = [], array $headers = []): mixed;

    /**
     * Perform a DELETE request on a REST API with a JSON body
     * Allow only JSON response
     *
     * @param string $url
     * @param array $parameters
     * @param array $headers
     * @return array
     * @throws ExceptionInterface
     */
    public function delete(string $url, array $parameters = [], array $headers = []): mixed;
}
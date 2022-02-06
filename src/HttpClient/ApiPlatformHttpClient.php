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

use Symfony\Component\HttpFoundation\Request;

class ApiPlatformHttpClient extends JsonRestHttpClient implements JsonRestHttpClientInterface
{

    /**
     * @inheritDoc
     */
    public function patch(string $url, array $parameters = [], array $headers = []): array
    {
        $headers['Content-Type'] = 'application/merge-patch+json';
        $headers['Accept'] = 'application/json';
        return $this->run(Request::METHOD_PATCH, $url, $parameters, $headers);
    }
}
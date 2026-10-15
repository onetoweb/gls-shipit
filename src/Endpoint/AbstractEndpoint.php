<?php

namespace Onetoweb\Gls\Shipit\Endpoint;

use Onetoweb\Gls\Shipit\Client;

/**
 * Abstract Endpoint.
 */
abstract class AbstractEndpoint implements EndpointInterface
{
    /**
     * @param Client $client
     */
    public function __construct(
        protected Client $client
    ) {
        
    }
}

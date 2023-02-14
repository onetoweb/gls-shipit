<?php

namespace Onetoweb\Gls\Shipit\Endpoint;

/**
 * Timeframe Endpoint.
 */
class Timeframe extends AbstractEndpoint
{
    /**
     * @param array $data = []
     * 
     * @return array|null
     */
    public function deliverydays(array $data = []): ?array
    {
        return $this->client->post('/backend/rs/timeframe/deliverydays', $data);
    }
}
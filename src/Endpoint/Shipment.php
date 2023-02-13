<?php

namespace Onetoweb\Gls\Shipit\Endpoint;

/**
 * Shipment Endpoint.
 */
class Shipment extends AbstractEndpoint
{
    /**
     * @param array $data = []
     * 
     * @return array|null
     */
    public function create(array $data = []): ?array
    {
        return $this->client->post('/backend/rs/shipments', $data);
    }
}
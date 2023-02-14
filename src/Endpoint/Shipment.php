<?php

namespace Onetoweb\Gls\Shipit\Endpoint;

use DateTime;

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
    
    /**
     * @param string $trackId
     * 
     * @return array|null
     */
    public function cancel(string $trackId): ?array
    {
        return $this->client->post("/backend/rs/shipments/cancel/$trackId");
    }
    
    /**
     * @param array $data = []
     * 
     * @return array|null
     */
    public function getAllowedServices(array $data = []): ?array
    {
        return $this->client->post('/backend/rs/shipments/allowedservices', $data);
    }
    
    /**
     * @param DateTime $date
     * 
     * @return array|null
     */
    public function getEndOfDayReport(DateTime $date): ?array
    {
        return $this->client->post('/backend/rs/shipments/endofday', [], [
            'date' => $date->format('Y-m-d')
        ]);
    }
    
    /**
     * @param string $trackId
     * @param float $weight
     * 
     * @return array|null
     */
    public function updateParcelWeight(string $trackId, float $weight): ?array
    {
        return $this->client->post('/backend/rs/shipments/updateparcelweight', [
            'TrackID' => $trackId,
            'Weight' => $weight
        ]);
    }
}
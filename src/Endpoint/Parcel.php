<?php

namespace Onetoweb\Gls\Shipit\Endpoint;

use DateTime;

/**
 * Parcel Endpoint.
 */
class Parcel extends AbstractEndpoint
{
    /**
     * @param DateTime $dateFrom
     * @param DateTime $dateTo
     * 
     * @return array|null
     */
    public function track(DateTime $dateFrom, DateTime $dateTo): ?array
    {
        return $this->client->post('/backend/rs/tracking/parcels', [
            'DateFrom' => $dateFrom->format('Y-m-d'),
            'DateTo' => $dateTo->format('Y-m-d')
        ]);
    }
    
    /**
     * @param string $trackID
     *
     * @return array|null
     */
    public function details(string $trackID): ?array
    {
        return $this->client->post('/backend/rs/tracking/parceldetails', [
            'TrackID' => $trackID
        ]);
    }
}
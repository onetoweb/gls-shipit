<?php

namespace Onetoweb\Gls\Shipit\Endpoint;

/**
 * Parcelshop Endpoint.
 */
class Parcelshop extends AbstractEndpoint
{
    /**
     * @param string $parcelShopId
     * 
     * @return array|null
     */
    public function get(string $parcelShopId): ?array
    {
        return $this->client->get("/backend/rs/parcelshop/$parcelShopId");
    }
    
    /**
     * @param string $countryCode
     *
     * @return array|null
     */
    public function getByCountry(string $countryCode): ?array
    {
        return $this->client->get("/backend/rs/parcelshop/country/$countryCode");
    }
    
    /**
     * @param array $data
     *
     * @return array|null
     */
    public function getParcelShopsInArea(array $data): ?array
    {
        return $this->client->post('/backend/rs/parcelshop/area', $data);
    }
}
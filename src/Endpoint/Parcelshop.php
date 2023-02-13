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
}
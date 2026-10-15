<?php

namespace Onetoweb\Gls\Shipit;

use GuzzleHttp\Client as GuzzleCLient;
use GuzzleHttp\RequestOptions;
use GuzzleHttp\Psr7\Response;
use Onetoweb\Gls\Shipit\Endpoint\EndpointInterface;
use Onetoweb\Gls\Shipit\Endpoint;
use Onetoweb\Gls\Shipit\Config\Method;

/**
 * Gls ShipIT Rest Api Client.
 */
class Client
{
    /**
     * @var string
     */
    private ?string $requester = null;
    
    /**
     * @var EndpointInterface
     */
    public ?EndpointInterface $shipment = null;
    
    /**
     * @var EndpointInterface
     */
    public ?EndpointInterface $parcel = null;
    
    /**
     * @var EndpointInterface
     */
    public ?EndpointInterface $parcelshop = null;
    
    /**
     * @var EndpointInterface
     */
    public ?EndpointInterface $timeframe = null;
    
    /**
     * @param string $username
     * @param string $password
     * @param string $baseHref
     */
    public function __construct(
        
        #[\SensitiveParameter]
        private string $username,
        
        #[\SensitiveParameter]
        private string $password,
        
        #[\SensitiveParameter]
        private string $baseHref
    ) {
        // load endpoints
        $this->loadEndpoints();
    }
    
    /**
     * @return void
     */
    private function loadEndpoints(): void
    {
        $this->shipment = new Endpoint\Shipment($this);
        $this->parcel = new Endpoint\Parcel($this);
        $this->parcelshop = new Endpoint\Parcelshop($this);
        $this->timeframe = new Endpoint\Timeframe($this);
    }
    
    /**
     * @param string $endpoint
     * 
     * @return string
     */
    public function getUrl(string $endpoint): string
    {
        return rtrim($this->baseHref, '/') . '/' . ltrim($endpoint, '/');
    }
    
    /**
     * @param string $requester
     */
    public function setRequester(string $requester): void
    {
        $this->requester = $requester;
    }
    
    /**
     * @param string $endpoint
     * @param array $query = []
     *
     * @return array|null
     */
    public function get(string $endpoint, array $query = []): ?array
    {
        return $this->request(Method::GET, $endpoint, [], $query);
    }
    
    /**
     * @param string $endpoint
     * @param array $data = []
     * @param array $query = []
     * 
     * @return array|null
     */
    public function post(string $endpoint, array $data = [], array $query = []): ?array
    {
        return $this->request(Method::POST, $endpoint, $data, $query);
    }
    
    /**
     * @param Response $response
     * 
     * @return array
     */
    private function errorHandler(Response $response): array
    {
        // build error
        $error = [];
        
        $errorHeaders = [
            'error',
            'message',
            'args'
        ];
        
        foreach ($errorHeaders as $errorHeader) {
            
            if ($response->hasHeader($errorHeader)) {
                $error[$errorHeader] = $response->getHeaderLine($errorHeader);
            }
        }
        
        if (count($error) == 0) {
            
            $error['code'] = $response->getStatusCode();
            $error['message'] = $response->getReasonPhrase();
        }
        
        return $error;
    }
    
    /**
     * @param Method $method
     * @param string $endpoint
     * @param array $data = []
     * @param array $query = []
     * 
     * @return array|null
     */
    public function request(Method $method, string $endpoint, array $data = [], array $query = []): ?array
    {
        // build options
        $options = [
            RequestOptions::HTTP_ERRORS => false,
            RequestOptions::HEADERS => [
                'Accept' => 'application/glsVersion1+json, application/json',
                'Content-Type' => 'application/glsVersion1+json',
            ],
            RequestOptions::AUTH => [
                $this->username,
                $this->password
            ],
            RequestOptions::JSON => $data,
            RequestOptions::QUERY => $query
        ];
        
        // add requester
        if ($this->requester !== null) {
            $options[RequestOptions::HEADERS]['Requester'] = $this->requester;
        }
        
        // make request
        $response = (new GuzzleCLient())->request($method->value, $this->getUrl($endpoint), $options);
        
        // handle errors
        if ($response->getStatusCode() !== 200) {
            return $this->errorHandler($response);
        }
        
        // get contents
        $contents = $response->getBody()->getContents();
        
        // decode json
        $json = json_decode($contents, true);
        
        return $json;
    }
}

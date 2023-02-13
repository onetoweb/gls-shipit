<?php

namespace Onetoweb\Gls\Shipit;

use GuzzleHttp\Client as GuzzleCLient;
use GuzzleHttp\RequestOptions;
use GuzzleHttp\Psr7\Response;
use Onetoweb\Gls\Shipit\Endpoint;

/**
 * Gls ShipIT Rest Api Client.
 */
class Client
{
    /**
     * Methods.
     */
    public const METHOD_GET = 'GET';
    public const METHOD_POST = 'POST';
    
    /**
     * @var string
     */
    private $username;
    
    /**
     * @var string
     */
    private $password;
    
    /**
     * @var string
     */
    private $baseHref;
    
    /**
     * @var string
     */
    private $requester;
    
    /**
     * @var Endpoint\EndpointInterface
     */
    public $shipment;
    
    /**
     * @var Endpoint\EndpointInterface
     */
    public $parcel;
    
    /**
     * @var Endpoint\EndpointInterface
     */
    public $parcelshop;
    
    /**
     * @param string $username
     * @param string $password
     * @param string $baseHref
     */
    public function __construct(string $username, string $password, string $baseHref)
    {
        $this->username = $username;
        $this->password = $password;
        $this->baseHref = $baseHref;
        
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
        return $this->request(self::METHOD_GET, $endpoint, [], $query);
    }
    
    /**
     * @param string $endpoint
     * @param array $data = []
     * 
     * @return array|null
     */
    public function post(string $endpoint, array $data = []): ?array
    {
        return $this->request(self::METHOD_POST, $endpoint, $data);
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
        
        if (count($error) > 0) {
            
            $error['code'] = $response->getStatusCode();
            $error['message'] = $response->getReasonPhrase();
        }
        
        return $error;
    }
    
    /**
     * @param string $method
     * @param string $endpoint
     * @param array $data = []
     * @param array $query = []
     * 
     * @return array|null
     */
    public function request(string $method, string $endpoint, array $data = [], array $query = []): ?array
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
        $response = (new GuzzleCLient())->request($method, $this->baseHref.$endpoint, $options);
        
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
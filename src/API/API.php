<?php

namespace AWSM\LibAPI\API;

use GuzzleHttp\Client;
use AWSM\LibAPI\Auth\AuthInterface;

/**
 * Parent Class for APIs.
 * 
 * @since 1.0.0
 */
abstract class API {
    /**
     * Field name for client id which will be sent to auth server.
     * 
     * @var AuthInterface
     * 
     * @since 1.0.0
     */
    protected AuthInterface $auth;

    /**
     * Constructor
     * 
     * @param AuthInterface
     * 
     * @since 1.0.0
     */
    public function __construct( AuthInterface $auth ) {
        $this->auth = $auth;
    }

    /**
     * Fields to send.
     * 
     * Can be overwritten and extended by child class.
     * 
     * @return array Fields which will be sent on authorization.
     * 
     * @since 1.0.0
     */
    protected function headers() : array {
        $headers = $this->auth->getAuthHeaders();
        return $headers;
    }

    /**
     * API Url
     * 
     * @return string
     * 
     * @since 1.0.0
     */
    abstract protected function getUrl() : string;

    public function request( string $endpoint, string $method, array $params = [] ) {
        $client = new Client();

        $url = $this->getUrl() . $endpoint;

        $options = [
            'headers' => $this->headers(),
        ];

        switch( $method ) {
            case 'GET':
                $options['query'] = $params;
                break;
            case 'POST':
                $options['form_params'] = $params;
                break;
        }

        $response = $client->request( $method, $url, $options )->getBody()->getContents();
        return $this->processResponse( $response );
    }

    /**
     * Processing response.
     * 
     * @param mixed
     * 
     * @since 1.0.0
     */
    protected function processResponse( $data ) {
        return json_decode( $data );
    }
}
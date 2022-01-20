<?php

namespace AWSM\LibAPI\Auth;

use GuzzleHttp\Client;
use AWSM\LibAPI\Tools\Token;

/**
 * Parent Class OAuth 2.
 * 
 * @since 1.0.0
 */
abstract class OAuth implements AuthInterface {
    /**
     * Field name for client id which will be sent to auth server.
     * 
     * @since 1.0.0
     */
    protected string $fieldClientId = 'client_id';

    /**
     * Field name for client secretwhich will be sent to auth server.
     * 
     * @since 1.0.0
     */
    protected string $fieldClientSecret = 'client_secret';

    /**
     * Field name for client secretwhich will be sent to auth server.
     * 
     * @since 1.0.0
     */
    protected string $fieldRefreshToken = 'refresh_token';

    /**
     * Client ID.
     * 
     * @since 1.0.0
     */
    protected string $clientId;

    /**
     * Client secret.
     * 
     * @since 1.0.0
     */
    protected string $clientSecret;

    /**
     * Auth token.
     * 
     * @since 1.0.0
     */
    protected Token $accessToken;

    /**
     * Refresh token.
     * 
     * @since 1.0.0
     */
    protected Token $refreshToken;

    /**
     * Constructur.
     * 
     * @since 1.0.0 
     */
    public function __construct( string $clientId, string $clientSecret ) {
        if ( empty( $this->getUrl() ) ) {
            // Throw error
        }

        $this->clientId     = $clientId;
        $this->clientSecret = $clientSecret;
    }

    /**
     * Auth server endpoint url.
     * 
     * @return string URL to endpoint.
     * 
     * @since 1.0.0
     */
    abstract protected function getUrl() : string;

    /**
     * Get client Id.
     * 
     * @return string Client id.
     * 
     * @since 1.0.0
     */
    protected function getClientId() : string {
        return $this->clientId;
    }

    /**
     * Get client secret.
     * 
     * @return string Client id.
     * 
     * @since 1.0.0
     */
    protected function getClientSecret() : string {
        return $this->clientSecret;
    }

    /**
     * Authorization process.
     * 
     * @since 1.0.0
     */
    public function getAccessToken() : Token {
        if( empty( $this->accessToken ) ) {
            $this->createAccessToken();
        }

        return $this->accessToken;
    }

    /**
     * Create access token.
     * 
     * @since 1.0.0
     */
    protected function createAccessToken() {
        $client = new Client();

        $options = [
            'headers'     => $this->headers(),
            'form_params' => $this->paramsAuth()
        ];

        $time     = time();
        $response = $client->request( 'POST', $this->getUrl(), $options );

        if ( $response->getStatusCode() !== 200 ) {
            // Throw error
        }

        $data = $this->processResponse( $response->getBody()->getContents() );

        $this->accessToken = new Token( $data->access_token, $time, $data->expires_in );

        if( property_exists( $data, 'refresh_token' ) ) {
            $this->refreshToken = new Token( $data->refresh_token, $time, $data->refresh_expires_in );
        }

        unset( $data );
    }

    /**
     * Auth headers for API requests.
     * 
     * @return array Auth headers.
     * 
     * @since 1.0.0
     */
    public function getAuthHeaders() : array {
        return [
            'Authorization' => 'Bearer ' . $this->getAccessToken()->getToken(),
        ];
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
        $headers = [
            'Content-Type' => 'application/x-www-form-urlencoded'
        ];

        return $headers;
    }

    /**
     * Base params.
     * 
     * Can be overwritten and extended by child class.
     * 
     * @return array Fields which will be sent on authorization.
     * 
     * @since 1.0.0
     */
    protected function params() : array {
        $params = [
            $this->fieldClientId => $this->getClientId()
        ];

        return $params;
    }

    /**
     * Params for first auth.
     * 
     * Can be overwritten and extended by child class.
     * 
     * @return array Fields which will be sent on authorization.
     * 
     * @since 1.0.0
     */
    protected function paramsAuth() : array {
        $params = $this->params();

        $params[ $this->fieldClientSecret ] = $this->getClientSecret();
        $params['grant_type']               = 'client_credentials';
        return $params;
    }

    /**
     * Params for renewal auth.
     * 
     * Can be overwritten and extended by child class.
     * 
     * @return array Fields which will be sent on authorization.
     * 
     * @since 1.0.0
     */
    protected function paramsRenewAuth() : array {
        $params = $this->params();

        $params[ $this->fieldRefreshToken ] = $this->refreshToken;
        $params['grant_type']               = 'refresh_token';
        return $params;
    }
}
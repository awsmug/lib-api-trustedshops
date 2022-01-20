<?php

namespace AWSM\LibAPI\Auth;

/**
 * Parent Class for basic auth.
 * 
 * @since 1.0.0
 */
abstract class Basic implements AuthInterface {
    /**
     * Token string.
     * 
     * @var string
     * 
     * @since 1.0.0
     */
    protected $token;

    /**
     * Constructur.
     * 
     * @since 1.0.0 
     */
    public function __construct( string $token ) {
        $this->token = $token;
    }

    /**
     * Get token.
     * 
     * @return string
     * 
     * @since 1.0.0
     */
    protected function getToken() : string {
        return $this->token;
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
            'Authorization' => 'Basic ' . $this->getToken(),
        ];
    }
}
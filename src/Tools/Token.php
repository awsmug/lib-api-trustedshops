<?php

namespace AWSM\LibAPI\Tools;

/**
 * Token class
 * 
 * @since 1.0.0 
 */
class Token {
    /**
     * Token string
     * 
     * @since 1.0.0
     */
    protected string $token;

    /**
     * Timestamp when token was registered.
     * 
     * @since 1.0.0
     */
    protected string $timestamp;

    /**
     * Token string
     * 
     * @since 1.0.0
     */
    protected string $expiration;

    /**
     * Constructor
     * 
     * @param string $token      Token string.
     * @param int    $timestamp  Unix timestamp of the moment, the token was received.
     * @param int    $expiration Expiration in seconds.
     * 
     * @since 1.0.0
     */
    public function __construct( string $token, int $timestamp, int $expiration ) {
        $this->token     = $token;
        $this->timestamp = $timestamp;
        $this->expiration   = $expiration;
    }

    /**
     * Checks if token has expired.
     * 
     * @return bool True if token has expired, false if not.
     * 
     * @since 1.0.0
     */
    public function hasExpired() : bool {
        if( $this->timestamp + $this->expiration > time() ) {
            return false;
        }

        return true;
    }

    /**
     * Get token.
     * 
     * @return string Token string.
     * 
     * @since 1.0.0
     */
    public function getToken() : string {
        return $this->token;
    }

    /**
     * Get timestamp.
     * 
     * @return string Unix timestamp of the moment, the token was received.
     * 
     * @since 1.0.0
     */
    public function getTimestamp() : int {
        return $this->timestamp;
    }

    /**
     * Get expiration.
     * 
     * @return string Token string.
     * 
     * @since 1.0.0
     */
    public function getExpiration() : int {
        return $this->expiration;
    }
}
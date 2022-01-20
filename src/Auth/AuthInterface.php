<?php

namespace AWSM\LibAPI\Auth;

/**
 * Auth interface.
 * 
 * @since 1.0.0
 */
interface AuthInterface {
    /**
     * Get authentication headers.
     * 
     * @return array
     * 
     * @since 1.0.0
     */
    public function getAuthHeaders() : array;
}
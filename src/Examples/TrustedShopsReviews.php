<?php

namespace AWSM\LibAPI\Examples;

use AWSM\LibAPI\Routes\Route;
use AWSM\LibAPI\Tools\Methods;
use AWSM\LibAPI\Tools\Types;

/**
 * Trusted shops auth.
 * 
 * @since 1.0.0
 */
class TrustedShopsReviews extends Route {

    /**
     * Constructor
     * 
     * @param TrustedShopsAPI
     * 
     * @since 1.0.0
     */
    public function __construct( TrustedShopsAPI $api ) {
        parent::__construct( $api, '/reviews' );
    }

    /**
     * Route methods
     * 
     * @return array
     * 
     * @since 1.0.0
     */
    protected function methods() : array {
        $methods = [
            Methods::GET => [
                'channels' => [
                    'type' => Types::STRING,
                ],
                'after' => [
                    'type' => Types::STRING,
                ],
                'before' => [
                    'type' => Types::STRING,
                ],
                'submittedAfter' => [
                    'type' => Types::STRING,
                ],
                'submittedBefore' => [
                    'type' => Types::STRING,
                ],
                'count' => [
                    'type' => Types::STRING,
                ],
                'rating' => [
                    'type' => Types::STRING,
                ],
                'status' => [
                    'type' => Types::STRING,
                ],
                'type' => [
                    'type' => Types::STRING,
                ],
                'hasReply' => [
                    'type' => Types::BOOL,
                ],
                'additionalInformation' => [
                    'type' => Types::STRING,
                ],
                'ignoreStatements' => [
                    'type' => Types::BOOL,
                ],
                'query' => [
                    'type' => Types::STRING,
                ],
                'orderBy' => [
                    'type' => Types::STRING,
                ],
            ]
        ];

        return $methods;
    }
}
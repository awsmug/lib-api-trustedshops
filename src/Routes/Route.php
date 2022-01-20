<?php

namespace AWSM\LibAPI\Routes;

use AWSM\LibAPI\API\API;
use AWSM\LibAPI\Exceptions\Exception;
use AWSM\LibAPI\Tools\Methods;

/**
 * Class Route.
 * 
 * @since 1.0.0
 */
abstract class Route {
    /**
     * API
     * 
     * @var API
     * 
     * @since 1.0.0
     */
    protected API $api;

    /**
     * Endpoint
     * 
     * @var string
     * 
     * @since 1.0.0
     */
    protected string $endpoint;

    /**
     * Route methods
     * 
     * @var array
     * 
     * @since 1.0.0
     */
    protected array $methods;

    /**
     * Constructor
     * 
     * @since 1.0.0
     */
    public function __construct( API $api, string $endpoint ) {
        $this->api      = $api;
        $this->endpoint = $endpoint;

        $this->initRoute();
    }

    /**
     * Initialize Route.
     * 
     * @since 1.0.0
     */
    private function initRoute() {
        $this->methods = $this->methods();
    }

    /**
     * Child class method initializiation.
     * 
     * Put in the methods with fields here.
     * 
     * @return RouteMethod[] An array of all methods in endpoint.
     * 
     * @since 1.0.0
     */
    abstract protected function methods() : array;

    /**
     * GET
     * 
     * @param array $filters Filter for endpoint
     * $filters = [
     *      [ 'fieldname1' => 'value1' ],
     *      [ 'fieldname2' => 'value2' ],
     *      [ 'fieldname3' => 'value2' ]
     *      ...
     * ]
     * 
     * @throws Exception
     * 
     * @since 1.0.0
     */
    public function get( array $filters ) {
        if( ! array_key_exists( Methods::GET, $this->methods ) ) {
            throw new Exception( sprintf( 'Method "%s" not found in route "%s".', Methods::GET, $this->endpoint ), 1 );
        }

        $fields = $this->methods[ Methods::GET ];

        $params = [];
        foreach( $filters AS $key => $value ) {
            if( ! array_key_exists( $key, $fields ) ) {
                throw new Exception( sprintf( 'Field "%s" not found in route "%s".',$key, $this->endpoint ), 2 );
            }

            // Doing more checks?

            $params[ $key ] = $value;
        }

        $response = $this->api->request( $this->endpoint, Methods::GET, $params );

        return $response->items;
    }

    /**
     * GET
     * 
     * @param array $values Filter for endpoint
     * $values = [
     *      [ 'fieldname1' => 'value1' ],
     *      [ 'fieldname2' => 'value2' ],
     *      [ 'fieldname3' => 'value2' ]
     *      ...
     * ]
     * 
     * @throws Exception
     * 
     * @since 1.0.0
     */
    public function post( array $values ) : bool {
        if( ! array_key_exists( Methods::POST, $this->methods ) ) {
            throw new Exception( sprintf( 'Method "%s" not found in route "%s".', Methods::GET, $this->endpoint ), 1 );
        }

        

        return true;
    }
}
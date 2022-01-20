<?php

namespace AWSM\LibAPI\Routes;

/**
 * Class Field
 * 
 * Represents a field in a route
 * 
 * @var API
 * 
 * @since 1.0.0
 */
class Field {
    /**
     * Name
     * 
     * @var string
     * 
     * @since 1.0.0
     */
    protected string $name;

    /**
     * Type
     * 
     * @var string
     * 
     * @since 1.0.0
     */
    protected string $type;

    /**
     * Constructor
     * 
     * @param string Name of field
     * @param string Type like int, string...
     * 
     * @since 1.0.0
     */
    public function __construct( string $name, string $type )
    {
        $this->name = $name;
        $this->type = $type;
    }

    /**
     * Get name.
     * 
     * @return string
     * 
     * @since 1.0.0
     */
    public function getName() : string {
        return $this->name;
    }

    /**
     * Get type.
     * 
     * @return string
     * 
     * @since 1.0.0
     */
    public function getType() : string {
        return $this->type;
    }
}
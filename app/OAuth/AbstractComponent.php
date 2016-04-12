<?php

namespace App\OAuth;

/**
 */
class AbstractComponent
{
    protected $provider;

    protected $userData;

    protected $driver;

    public function __construct($driver)
    {
        $this->driver = $driver;
    }

    public function getProviderName()
    {
        if ( is_null($this->provider) ) {
            throw new ProviderNotFound('???');
        }
        return $this->provider;
    }
}

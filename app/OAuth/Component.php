<?php

namespace App\OAuth;

use Illuminate\Contracts\Container\BindingResolutionException;
use Socialite;

/**
 */
abstract class Component
{
    protected $provider;

    protected $driver;

    protected $userData = null;

    public function __construct($driver, $config)
    {
        $this->config = $config;
        $this->driver = $driver;
        // try {
        //     $this->userData = $driver->user();
        // } catch (BindingResolutionException $e) {
        //     $this->userData = null;
        // }
    }

    public function getProviderName()
    {
        if ( is_null($this->provider) ) {
            throw new ProviderNotFound('???');
        }
        return $this->provider;
    }

    public function getDriver()
    {
        return $this->driver;
    }

    /**
     * OAuthドライバーの追加設定処理を行う（ログイン前処理用）
     */
    public function configureDriver()
    {

    }

    public function bindUserData()
    {
        if ( is_null($this->userData) ) {
            $this->userData = $this->driver->user();
        }
        return $this->userData;
    }

    public static function factory($provider)
    {
        switch ($provider) {
            case 'google':
                $ComponentClass = '\\App\\OAuth\\Component\\Google';
                break;
            case 'twitter':
                $ComponentClass = '\\App\\OAuth\\Component\\Twitter';
                break;
            default:
                throw new ProviderNotFound("Provider '${provider}' is not found.");
                break;
        }
        $driver = Socialite::driver($provider);
        $config = config("services.${provider}");
        $component = new $ComponentClass($driver, $config);
        return $component;
    }

    abstract public function getEmail();
    abstract public function getName();
    abstract public function getFormLabel();
}

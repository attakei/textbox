<?php

namespace App\OAuth;

use Socialite;


class Helper
{
    public static function factory($provider)
    {
        switch ($provider) {
            case 'google':
                $ComponentClass = '\\App\\OAuth\\Component\\Google';
                break;
            default:
                throw new ProviderNotFound("Provider '${provider}' is not found.");
                break;
        }
        $driver = Socialite::driver($provider);
        $component = new $ComponentClass($driver);
        return $component;
    }
}

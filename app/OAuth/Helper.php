<?php

namespace App\OAuth;

class Helper
{
    public static function factory($provider)
    {
        throw new ProviderNotFound("Provider '${provider}' is not found.");
    }
}

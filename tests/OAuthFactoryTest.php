<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\OAuth\Helper;


class OAuthFactoryTest extends \TestCase
{
    /**
     * @expectedException        App\OAuth\ProviderNotFound
     * @expectedExceptionMessage Provider 'nijibox' is not found.
     */
    public function testNotFound()
    {
        Helper::factory('nijibox');
    }
}

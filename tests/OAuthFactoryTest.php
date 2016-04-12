<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\OAuth\Component;


class OAuthFactoryTest extends \TestCase
{
    /**
     * @expectedException        App\OAuth\ProviderNotFound
     * @expectedExceptionMessage Provider 'nijibox' is not found.
     */
    public function testNotFound()
    {
        Component::factory('nijibox');
    }

    public function testExistComponent()
    {
        $component = Component::factory('google');
        $this->assertInstanceOf('App\OAuth\Component\Google', $component);
        $this->assertInstanceOf('App\OAuth\Component', $component);
        $this->assertEquals($component->getProviderName(), 'google');
    }

}

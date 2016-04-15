<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;


class UserControllerTest extends \TestCase
{
    protected function setupTestData()
    {
        DB::transaction(function ()
        {
            User::create(['name'=>'test_user_1', 'email' => 'user1@example.com', 'password' => '']);
        });
    }

    /**
     * ユーザー名だけだけど変えられること
     *
     * @return void
     */
    public function testEditUserProfileOk()
    {
        $this->setupTestData();
        $testUser = User::find(1);
        $beforeUserName = $testUser->name;
        $this->be($testUser);
        $response = $this->action('POST', 'UserController@editProfile', ['name' => 'test_user_2']);
        $this->assertEquals($response->getStatusCode(), 302);
        $location = $response->headers->get('location');
        $this->assertRegExp('|/users/_me/profile|', $location);
        $testUser = User::find(1);
        $this->assertNotEquals($testUser->name, $beforeUserName);
    }

    /**
     * ユーザー名だけだけど変えられること
     *
     * @return void
     */
    public function testEditUserProfileNotModified()
    {
        $this->setupTestData();
        $testUser = User::find(1);
        $beforeUserName = $testUser->name;
        $this->be($testUser);
        $response = $this->action('POST', 'UserController@editProfile', ['name' => $beforeUserName]);
        $this->assertEquals($response->getStatusCode(), 200);
        // $location = $response->headers->get('location');
        // $this->assertRegExp('|/users/_me/profile|', $location);
    }

    /**
     * ユーザー名だけだけど変えられること
     *
     * @return void
     */
    public function testEditUuserInvalidatedPost()
    {
        $this->setupTestData();
        $testUser = User::find(1);
        $beforeUserName = $testUser->name;
        $this->be($testUser);
        $response = $this->action('POST', 'UserController@editProfile', []);
        $this->assertEquals($response->getStatusCode(), 200);
        // $location = $response->headers->get('location');
        // $this->assertRegExp('|/users/_me/profile|', $location);
    }
}

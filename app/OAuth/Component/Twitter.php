<?php

namespace App\OAuth\Component;

use App\OAuth\Component;

class Twitter extends Component
{
    protected $provider = 'twitter';

    public function getEmail()
    {
        return sprintf('%s@twitter', $this->bindUserData()->getId());
    }

    public function getName()
    {
        return $this->bindUserData()->getNickname();
    }

    public function getFormLabel()
    {
        return 'Twitterアカウントでログイン';
    }
}

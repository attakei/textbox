<?php

namespace App\OAuth\Component;

use App\OAuth\Component;

class Google extends Component
{
    protected $provider = 'google';

    public function getEmail()
    {
        return $this->bindUserData()->getEmail();
    }

    public function getName()
    {
        $name = $this->bindUserData()->getName();
        // 名前の取得に失敗したら、メールアドレスから作り直す
        // TODO: 汎用性がない
        if ( $name == '' ) {
            $mail = $this->getEmail();
            list($name, $domain) = explode('@', $mail);
            $name = str_replace('.', ' ', $name);
            $name = ucwords($name);
        }
        return $name;
    }

    public function getFormLabel()
    {
        return 'Googleアカウントでログイン';
    }

}

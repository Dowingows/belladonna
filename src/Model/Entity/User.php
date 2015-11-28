<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;

class User extends Entity {

    protected $_accessible = [
        'name' => true,
        'email' => true,
        'password' => true,
        'profile_id' => true
    ];

    protected function _setPassword($password) {
        return (new DefaultPasswordHasher)->hash($password);
    }

    public function setDefaultPassword() {
        $defaultPassword = '123456';

        $this->password = $defaultPassword;

        return true;
    }

}

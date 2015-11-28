<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class ProfilesTable extends Table {

    public function initialize(array $config) {
        $this->addBehavior('Timestamp');

        $this->belongsToMany('Actions', [
            'joinTable' => 'profiles_actions',
        ]);
        
        $this->hasMany('Users');

        $this->displayField('name');
    }

    public function validationDefault(Validator $validator) {
        return $validator->notEmpty('name', 'Campo não pode ser vazio!');
    }

}

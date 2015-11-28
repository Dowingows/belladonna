<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class ActionsTable extends Table {

    public function initialize(array $config) {
        $this->addBehavior('Timestamp');
        $this->displayField('action_label');
        $this->belongsTo('Areas', ['foreingKey' => 'area_id']);
         $this->belongsToMany('Profiles', [
            'joinTable' => 'profiles_actions',
        ]);
    }

    public function validationDefault(Validator $validator) {
        return $validator
                        ->notEmpty('action', 'Campo não pode ser vazio!')
                        ->notEmpty('action_label', 'Campo não pode ser vazio!');
    }

}

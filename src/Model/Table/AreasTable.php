<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class AreasTable extends Table {

    public function initialize(array $config) {
        $this->addBehavior('Timestamp');
        $this->displayField('controller_label');

        $this->hasMany('Actions', [
            'foreignKey' => 'area_id',
            'dependent' => true
        ]);

        $this->hasMany('Children', [
            'className' => 'Areas',
            'foreignKey' => 'parent_id',
        ]);


        $this->belongsTo('Parents', [
            'className' => 'Areas',
            'foreignKey' => 'parent_id'
        ]);
    }

    public function validationDefault(Validator $validator) {
        return $validator
                        ->notEmpty('controller', 'Campo não pode ser vazio!')
                        ->notEmpty('controller_label', 'Campo não pode ser vazio!');
    }

}

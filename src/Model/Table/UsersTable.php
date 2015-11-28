<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Event\Event;
use Cake\ORM\Entity;

class UsersTable extends Table {

    protected $_accessible = [
        'password' => true,
        'currentPassword' => true
    ];
    private $password = '';

    public function initialize(array $config) {
        $this->addBehavior('Timestamp');
        $this->belongsTo('Profiles', ['foreignKey' => 'profile_id']);
    }

    public function validationDefault(Validator $validator) {
        return $validator
                        ->notEmpty('email', 'Campo não pode ser vazio!')
                        ->add('email', 'unique', [
                            'message' => 'Email já cadastrado, tente outro!',
                            'rule' => 'validateUnique',
                            'provider' => 'table'])
                        ->add('email', 'email', [
                            'message' => 'Email inválido!',
                            'rule' => 'email'])
                        ->allowEmpty('currentPassword', function() {
                            return true;
                        })
                        ->add('currentPassword', 'validPassword', [
                            'rule' => [$this, 'validPassword'],
                            'message' => 'Senha inválida! Tente novamente',
                        ])->notEmpty('newPassword', 'Campo não pode ser vazio!', function($context) {
                            return !empty($context['data']['currentPassword']);
                        })
                        ->add('newPassword', 'confirmPassword', [
                            'rule' => [$this, 'confirmPassword'],
                            'message' => 'Senha de verificação não confere!'
                        ])
                        ->notEmpty('profile_id', 'Campo não pode ser vazio!');
    }

    public function validPassword($value, $context) {
        $query = $this->findById($context['data']['id']);
        $user = $query->first();
        return (new DefaultPasswordHasher)->check($value, $user->password);
    }

    public function confirmPassword($value, $context) {
        if (empty($context['data']['currentPassword'])) {
            return true;
        } else {
            if (empty($value)) {
                return 'Campo não pode ser vazio!!';
            } else {
                return ($context['data']['newPassword'] == ($context['data']['newPasswordConfirm']));
            }
        }
    }

    public function beforeMarshal(Event $event, \ArrayObject &$data) {
        if (!empty($data['newPassword'])) {
            $data['password'] = $data['newPassword'];
        }
        return true;
    }

    public function beforeSave(Event $event, Entity $entity) {
        if ($entity->isNew()) {
            $entity->setDefaultPassword();
        }
    }

}

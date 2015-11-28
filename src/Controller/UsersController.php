<?php

namespace App\Controller;

class UsersController extends AppController {

    public $name = 'Users';
    public $paginate = [
        'limit' => 5,
        'contain' => ['Profiles']
    ];

    public function initialize() {
        parent::initialize();
        $this->loadModel();
    }

    public function index() {
        $this->checkAccess($this->name, __FUNCTION__);
        $this->set('users', $this->paginate());
    }

    public function view($id) {
        $this->checkAccess($this->name, __FUNCTION__);
        $user = $this->Users->get($id);
        $this->set(compact('user'));
    }

    public function add() {
        $this->checkAccess($this->name, __FUNCTION__);
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Usuário salvo com sucesso!'));
                return $this->redirect(['action' => 'add']);
            }
            $this->Flash->error(__('Erro ao salvar usuário!'));
        }
        $this->set('user', $user);
        $this->profilesList();
    }

    public function edit($id) {
        $this->checkAccess($this->name, __FUNCTION__);
        $query = $this->Users->findById($id);
        $user = $query->first();
        if ($this->request->is(['post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Usuário salvo com sucesso!'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Erro ao salvar usuário!'));
        }
        $this->profilesList();
        $this->set('user', $user);
    }

    private function profilesList() {
        $profiles = $this->Users->Profiles->find('list');
        $this->set(compact('profiles'));
    }

    public function editAccount() {

        $session = $this->request->session();
        $user_id = !empty($session->read('Auth.User.id')) ? $session->read('Auth.User.id') : '';
        if (empty($user_id)) {
            $this->Flash->warning('Usuário invalido!!');
            $this->logout();
        } else {
            $query = $this->Users->find('all', [
                'conditions' => [
                    'Users.id' => $user_id
                ],
                'fields' => ['id', 'name', 'email', 'profile_id']
                    ]
            );
            $user = $query->first();

            if ($this->request->is(['post', 'put'])) {
                $user = $this->Users->patchEntity($user, $this->request->data);
                if ($this->Users->save($user)) {
                    $this->Flash->success(__('Usuário salvo com sucesso!'));
                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('Erro ao salvar usuário!'));
            }

            $this->set('user', $user);
            $this->profilesList();
        }
    }

    public function login() {
        $this->layout = "login";
        if ($this->request->is('post')) {

            $user = $this->Auth->identify();

            if ($user) {
                $this->setSessionUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            } else {
                $this->Flash->error(
                        __('Usuário ou senha incorretos!'), 'default', [], 'auth'
                );
            }
        }
    }

    public function logout() {
        $this->request->session()->destroy();
        return $this->redirect($this->Auth->logout());
    }

    public function delete($id) {
        $this->checkAccess($this->name, __FUNCTION__);
        $this->request->allowMethod(['post', 'delete']);
        $area = $this->Users->get($id);

        $id = (int) $id;
        if ($id > 0 && $id < 3) {
            $this->Flash->warning('Não é permitido remover este usuário!');
            return $this->redirect('/');
        }

        if ($this->Users->delete($area)) {
            $this->Flash->success(__('O usuário  foi  com sucesso!.'));
            return $this->redirect(['action' => 'index']);
        } else {
            $this->Flash->success(__('Erro ao excluir o usuário!'));
        }
    }

}

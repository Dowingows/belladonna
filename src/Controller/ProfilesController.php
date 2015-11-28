<?php

namespace App\Controller;

use App\Controller\AppController;

class ProfilesController extends AppController {

    public $name = 'Profiles';
    public $paginate = [
        'limit' => 5
    ];

    public function index() {
        $this->checkAccess($this->name, __FUNCTION__);
        $this->set('profiles', $this->paginate());
    }

    public function view($id) {
        $this->checkAccess($this->name, __FUNCTION__);
        $query = $this->Profiles->findById($id);
        $query->contain(['Actions' => [
                'Areas' => [
                    'fields' => ['id', 'controller', 'controller_label']
                ]
            ]
        ]);

        $profile = $query->first();

        $this->set(compact('profile'));
        $this->areasGroup($profile->actions);
    }

    //Format actions in groups of areas
    private function areasGroup($actions) {
        $groups = [];

        foreach ($actions as $action) {
            if (empty($groups[$action->area->controller])) {
                $groups[$action->area->controller] = [];
                $groups[$action->area->controller]['group_name'] = $action->area->controller_label;
                $groups[$action->area->controller]['actions'] = [];
            }

            array_push($groups[$action->area->controller]['actions'], $action->toArray());
        }

        $this->set('actions', $groups);
    }

    public function add() {
        $this->checkAccess($this->name, __FUNCTION__);
        $profile = $this->Profiles->newEntity();
        if ($this->request->is('post')) {
            $profile = $this->Profiles->patchEntity($profile, $this->request->data);
            if ($this->Profiles->save($profile)) {
                $this->Flash->success(__('Perfil salvo com sucesso!'));
                return $this->redirect(['action' => 'view', $profile->id]);
            }
            $this->Flash->error(__('Erro ao salvar perfil!'));
        }
        $this->set('profile', $profile);
        $this->actionsList();
    }

    public function edit($id) {
        $this->checkAccess($this->name, __FUNCTION__);
        $query = $this->Profiles->findById($id);
        $query->contain(['Actions']);
        $profile = $query->first();

        $id = (int) $id;

        if ($id > 0 && $id < 2) {
            $this->Flash->warning('Não é permitido editar este perfil! (' . $profile->name . ') <=> Perfil do sistema');
            return $this->redirect('/');
        }

        if ($this->request->is(['post', 'put'])) {
            $profile = $this->Profiles->patchEntity($profile, $this->request->data);
            if ($this->Profiles->save($profile)) {
                $this->Flash->success(__('Perfil salvo com sucesso!'));
                return $this->redirect(['action' => 'view', $profile->id]);
            }
            $this->Flash->error(__('Erro ao salvar perfil!'));
        }
        $this->set('profile', $profile);
        $this->actionsList();
    }

    public function delete($id) {
        $this->checkAccess($this->name, __FUNCTION__);
        $this->request->allowMethod(['post', 'delete']);
        $perfil = $this->Profiles->get($id);
        $id = (int) $id;
        if ($id > 0 && $id < 2) {
            $this->Flash->warning('Não é permitido remover este perfil! (' . $profile->name . ') <=> Perfil do sistema');
            return $this->redirect('/');
        }


        if ($this->Profiles->delete($perfil)) {
            $this->Flash->success(__('O Perfil   foi removida com sucesso!.'));
            return $this->redirect(['action' => 'index']);
        } else {
            $this->Flash->success(__('Erro ao excluir o perfil  !'));
        }
    }

    private function actionsList() {
        $actionsList = $this->Profiles->Actions->find('list', [
                    'groupField' => 'area_id'
                ])->toArray();

        $actions = [];


        foreach ($actionsList as $key => $actionItem) {
            $query = $this->Profiles->Actions->Areas->findById($key);
            $area = $query->first();
            $actions[$area->controller_label] = $actionItem;
        }
        $this->set(compact('actions'));
    }

}

<?php

namespace App\Controller;

use App\Controller\AppController;

class AreasController extends AppController {

    public $name = 'Areas';
    public $paginate = [
        'limit' => 5
    ];

    public function index() {
        $this->checkAccess($this->name, __FUNCTION__);
        $this->set('areas', $this->paginate());
    }

    public function view($id) {
        $this->checkAccess($this->name, __FUNCTION__);
        $area = $this->Areas->get($id, ['contain' => ['Parents', 'Actions', 'Children' => ['Actions']]]);
        $this->set(compact('area'));
    }

    public function add() {
        $this->checkAccess($this->name, __FUNCTION__);
        $area = $this->Areas->newEntity();

        if ($this->request->is('post')) {

            $area = $this->Areas->patchEntity($area, $this->request->data, [
                'associated' => ['Actions'],
            ]);

            if ($this->Areas->save($area)) {
                $this->Flash->success(__('A área foi salva com sucesso!'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Erro ao salvar área!'));
        }
        $this->set('area', $area);
        $this->areasList();
    }

    public function edit($id) {
        $this->checkAccess($this->name, __FUNCTION__);

        $query = $this->Areas->findById($id);
        $query->contain(['Actions' => [
                'fields' => ['id', 'action', 'action_label', 'appear', 'area_id']
            ]
        ]);
        $area = $query->first();
        
        if ($id > 0 && $id < 5) {
            $this->Flash->warning('Não é permitido editar está área! (' . $area->controller_label . ') <=> Área do sistema');
            return $this->redirect('/');
        }
        
        $old = $area->actions;

        if ($this->request->is(['post', 'put'])) {

            $area = $this->Areas->patchEntity($area, $this->request->data, [
                'associated' => ['Actions'],
            ]);

            $new = $area->actions;

            if (empty($this->request->data['actions'])) {
                $items_trash = $old;
            } else {
                $items_trash = array_diff($old, $new);
            }

            foreach ($items_trash as $item) {
                $this->Areas->Actions->delete($item);
            }

            $area->dirty('actions', true);

            if ($this->Areas->save($area)) {
                $this->Flash->success(__('A área foi salva com sucesso!'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Erro ao salvar área!'));
        }
        $this->set('area', $area);
        $this->areasList();
    }

    public function delete($id) {
        $this->checkAccess($this->name, __FUNCTION__);
        $this->request->allowMethod(['post', 'delete']);
        $area = $this->Areas->get($id);

        $id = (int) $id;
        if ($id > 0 && $id < 5) {
            $this->Flash->warning('Não é permitido remover está área! (' . $area->controller_label . ')<=> Área do sistema');
            return $this->redirect('/');
        }

        if ($this->Areas->delete($area)) {
            $this->Flash->success(__('A área   {0} foi removida com sucesso!.', h($area->controller_label)));
            return $this->redirect(['action' => 'index']);
        } else {
            $this->Flash->success(__('Erro ao explucluir a área   {0} !', h($area->controller_label)));
        }
    }

    private function areasList() {
        $areasList = $this->Areas->find('list')->where(['abstract' => true]);
        $this->set(compact('areasList'));
    }

}

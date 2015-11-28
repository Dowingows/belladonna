<?php

/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */

namespace App\Controller;

use Cake\Controller\Controller;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * @return void
     */
    public $AppTitle = "Belladonna";
    public $gender = 'o';
    public $label = 'App Controller';
    public $layout = "bootstrap";

    public function initialize() {
        parent::initialize();

        $this->loadComponent('Auth', [
            'loginRedirect' => [
                'controller' => 'Pages',
                'action' => 'display'
            ],
            'logoutRedirect' => [
                'controller' => 'Users',
                'action' => 'login',
            ],
            'loginAction' => [
                'controller' => 'Users',
                'action' => 'login',
            ],
            'authError' => 'Você não pode acessar essa área!',
            'authenticate' => [
                'Form' => [
                    'fields' => ['username' => 'email']
                ]
            ],
            'storage' => 'Session'
        ]);

        $this->loadComponent('Flash');
        $this->loadModel('Areas');
    }
    
    public function beforeFilter(\Cake\Event\Event $event) {
        parent::beforeFilter($event);               
        $this->set('AppTitle', $this->AppTitle);
    }

    /**
     * 
     * @param array $user array format ['id'=>'','name'] (User fields in storage in session)    
     */
    
    protected function setSessionUser(array $user) {
        $this->loadModel('Users');
        
        $userData = [];
        if (!empty($user['id'])) {
            $userData = $this->Users->get($user['id'], [
                'contain' => [
                    'Profiles' => [
                        'fields' => ['id', 'name']
                    ],
                ],
                'fields' => ['id', 'name', 'email', 'last_login']
                    ]
            );

            $user = $userData->toArray();
            
            $this->Auth->setUser($user);

            $session = $this->request->session();

            $menusAndAccess = $this->AreasToMenuAndAccessFormat($user['profile']['id']);
            
            $session->write('Auth.Menus', $menusAndAccess['Menus']);
            $session->write('Auth.Access', $menusAndAccess['Access']);
        }
    }
    /*Versão em que as actions tem appear true
    
//    protected function findAreasByPerfil($profile_id){
//        $query = $this->Areas->find('all');
//        $contain = [
//            'Children'=>[
//                'Actions' => function($q) use($profile_id){
//                return $q->where(['appear' => true])->contain([
//                    'Profiles'=> function($q) use($profile_id){
//                        return $q->where(['Profiles.id'=>$profile_id]);
//                    }
//                ]);
//            }],
//            'Actions' => function($q) use($profile_id){
//                    return $q->where(['appear' => true])->contain([
//                        'Profiles'=> function($q) use($profile_id){
//                            return $q->where(['Profiles.id'=>$profile_id]);
//                        }
//                ]);
//            }
//        ];
//
//        $areas = $query->contain($contain)->where(['parent_id IS NULL'])->order(['controller' => 'ASC'])->toArray();
//
//                foreach($areas as $aKey=>&$area){
//                    if(!empty($area->actions)){
//                        foreach($area->actions as $key=>&$action){
//                            if(empty($action->profiles)){
//                                  unset($areas[$aKey]); 
//                            }
//                        }
//                    }else{
//                        foreach($area->children as $cKey=>&$child){
//                            foreach($child->actions as $key=>&$action){
//                                if(empty($action->profiles[0])){
//                                   unset($area->children[$cKey]);
//                                }
//                            }
//                        }
//                        if(empty($area->children)){
//                            unset($areas[$aKey]);
//                        }
//                    }
//                }
//                
//                return $areas;
//    }
     
     */
    
    protected function findAreasByPerfil($profile_id){
        $query = $this->Areas->find('all');
        $contain = [
            'Children'=>[
                'Actions' => function($q) use($profile_id){
                return $q->contain([
                    'Profiles'=> function($q) use($profile_id){
                        return $q->where(['Profiles.id'=>$profile_id]);
                    }
                ]);
            }],
            'Actions' => function($q) use($profile_id){
                    return $q->contain([
                        'Profiles'=> function($q) use($profile_id){
                            return $q->where(['Profiles.id'=>$profile_id]);
                        }
                ]);
            }
        ];

        $areas = $query->contain($contain)->where(['parent_id IS NULL'])->order(['controller' => 'ASC'])->toArray();

                foreach($areas as $aKey=>&$area){
                    if(!empty($area->actions)){      
                        foreach($area->actions as $key=>&$action){
                            //Remove ações que não possuem perfil do tipo informado
                            if(empty($action->profiles)){
                                  unset($areas[$aKey]->actions[$key]); 
                            }
                        }
//                        pr($area);die;
                        //remove área sem ações
                        if(empty($area->actions)){
                            unset($areas[$aKey]);
                        }
                    }else{
                        foreach($area->children as $cKey=>&$child){
                            foreach($child->actions as $key=>&$action){
                                if(empty($action->profiles[0])){
                                   unset($child->actions[$key]);
                                }
                            }
                            if(empty($child->actions)){
                                unset($area->children[$cKey]);
                            }
                        }
                        if(empty($area->children)){
                            unset($areas[$aKey]);
                        }
                    }
                }
                
                return $areas;
    }
    
    protected function formatSimpleAccessAction(&$actions){
        $accessAction = [];

        if(!empty($actions[0])){
           foreach($actions as $action){
               $accessAction['action'][$action->action] = $action->action_label;
           }
        }
       return $accessAction;
    }
    
    protected function AreasToMenuAndAccessFormat($profile_id) {
                $menus = [];
                $access = [];
                
                $areas = $this->findAreasByPerfil($profile_id);

                $active = false;

                foreach ($areas as $area) {
                    
                    $menu = [];
                    
                    if (!empty($area->actions[0])) {
                       
//                        $menu = ['controller_name'=>$area->controller,'label' => $area->controller_label, 'icon' => "<i class='{$area->icon_menu_class}'></i> ", 'active' => $active, 'url' => ['controller' => $area->controller, 'action' => "{$area->actions[0]->action}"]];
                        $menu = ['controller_name'=>$area->controller,'label' => $area->controller_label, 'icon' => "<i class='{$area->icon_menu_class}'></i> ", 'active' => $active, 'url' => ['controller' => $area->controller, 'action' => "index"]];
                        $access[$area->controller] =$this->formatSimpleAccessAction($area->actions); 
                        
                        array_push($menus, $menu);
                    } else if ($area->abstract) {
                        $children = [];

                        foreach ($area->children as $child) {
                            $val = ['controller_name'=>$child->controller,'label' => $child->controller_label, 'icon' => "<i class='{$child->icon_menu_class}'></i> ", 'active' => $active, 'url' => ['controller' => $child->controller, 'action' => "index"]];
                            array_push($children, $val);
                            
                            $access[$child->controller] =$this->formatSimpleAccessAction($child->actions); 
                        }
                        $menu = ['controller_name'=>$area->controller,'label' => $area->controller_label, 'icon' => "<i class='{$area->icon_menu_class}'></i> ", 'active' => $active, 'url' => ['#'], 'children' => $children];
                        
                        array_push($menus, $menu);
                    }
                }
                $menusAndAccess = [];
                $menusAndAccess['Menus'] = $menus;
                $menusAndAccess['Access'] = $access;

                return $menusAndAccess;
            }

   
    //Auth methods
    public function isAdmin(){
        $session = $this->request->session();
        return $session->read('Auth.User.profile.id') == 1;
    }
    
    protected function checkAccess($controller = null, $action = null) {

        if ($this->isAdmin()) {
            return true;
        }
        $session = $this->request->session();
        
        
        if ($controller == null || $action == null) {

            $this->Flash->warning("Ocorreu um erro de permissões. (erro: falta de parametros)", "default", array('class' => 'error'));
            $this->redirect("/");
        }

        if (!$session->check("Auth.User")) {

            $this->Flash->warning("Por favor, efetue login para ter acesso a esta área.", "default", array('class' => 'error'));
            $this->redirect("/");
        }
        
        if (!$session->check("Auth.Access.$controller")) {

            $this->Flash->warning("Você não tem acesso a esta Área ({$controller}).", "default", array('class' => 'error'));
            $this->redirect("/");
        }
        if (!$session->check("Auth.Access.$controller.action.$action")) {
           $this->Flash->warning("Você não tem acesso a esta operação ({$controller}->{$action}).", "default", array('class' => 'error'));
            $this->redirect("/");
        }
    }
    
}
        
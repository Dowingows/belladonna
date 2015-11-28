<?php

/* src/View/Helper/LinkHelper.php */

namespace App\View\Helper;

use Cake\View\Helper;

class MenuHelper extends Helper {

    public $helpers = ['Html', 'Frontend'];

    /**
     * ['label'=>'','url'=>['controller'=>'','action'=>''],'children'=>[''],'active']
     * 
     */
    public function show() {
        $session = $this->request->session();
        $menus = $session->read('Auth.Menus');

        return $this->create($menus, ['class' => 'nav navbar-nav']);
    }

    protected function create(array $menus, $attrs) {

        $menuBar = "";

        foreach ($menus as $menu) {

            $menu['active'] = ($this->request->params['controller'] == $menu['controller_name']);

            $classActive = $menu['active'] ? "active" : "";

            if (empty($menu['children'])) {
                $menuBar .= $this->Frontend->wrapElement('li', ['class' => $classActive], $this->Html->link($menu['icon'] . ' ' . $menu['label'], $menu['url'], ['escape' => false]));
            } else {
                $dropdownAttrs = [
                    'class' => 'dropdown-toggle',
                    'data-toggle' => 'dropdown',
                    'role' => 'button',
                    'aria-haspopup' => 'true',
                    'aria-expanded' => 'false',
                    'escape' => false
                ];

                $parentActive = "";
                if ($this->childrenHasSomeSelected($menu['children'])) {
                    $parentActive = "active";
                }

                $menuBar .= $this->Frontend->wrapElement('li', ['class' => 'dropdown ' . $parentActive], $this->Html->link($menu['icon'] . ' ' . $menu['label'] . '<span class="caret">', $menu['url'], $dropdownAttrs)
                        . $this->create($menu['children'], ['class' => 'dropdown-menu'])
                );
            }
        }

        return $this->Frontend->wrapElement('ul', ['class' => $attrs['class']], $menuBar);
    }

    protected function childrenHasSomeSelected(&$children) {

        foreach ($children as &$child) {
            $child['active'] = ($this->request->params['controller'] == $child['controller_name']);
            if ($child['active']) {
                return true;
            }
        }
        return false;
    }

}

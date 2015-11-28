<?php

/* src/View/Helper/LinkHelper.php */

namespace App\View\Helper;

use Cake\View\Helper;

class PanelHelper extends Helper {

    public function start(array $paramns) {
        $icon = empty($paramns['icon']) ? '' : "<i class='{$paramns['icon']}'></i>";
        $label = empty($paramns['label']) ? '' : $paramns['label'];
        $class = empty($paramns['class']) ? '' : $paramns['class'];
        
        $panel = "<div class='panel panel-default {$class}'>";
        if(!empty($label)){
            $panel .= "<div class='panel-heading'>{$icon} {$label}</div>";
        }
        $panel .= "<div class='panel-body'>";
        
        return $panel;
    }

    public function end() {
        $end = "</div></div>";
        return $end;
    }

}

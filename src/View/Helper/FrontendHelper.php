<?php

/* src/View/Helper/LinkHelper.php */

namespace App\View\Helper;

use Cake\View\Helper;

class FrontendHelper extends Helper {
    
    
    public function formatBool($field){
        if($field){
            return '<i class="glyphicon glyphicon-ok"></i>';
        }else{
            return '<i class="glyphicon glyphicon-remove"></i>';
        }
    }
    
    
    public function wrapDiv(array $attrs, $field) {
        $content = '<div ';
        foreach ($attrs as $key => $val) {
            $content .= $key . ' = ' . $val . ' ';
        }

        $content .= '>';
        $content .=$field;

        $content .="</div>";
        return $content;
    }

    public function wrapElement($tag, array $attrs, $element) {
        $content = "<{$tag} ";
        foreach ($attrs as $key => $val) {
            $content .= $key . ' = "' . $val . '" ';
        }

        $content .= '>';
        $content .=$element;

        $content .="</{$tag}>";
        return $content;
    }

}

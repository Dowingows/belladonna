<?php if (!empty($template)): ?>
    <?php

    $attrs = [];
    $size = empty($size) ? "" : $size;
    switch ($template) {
        case 'delete': $attrs = ['class' => "btn btn-danger {$size} glyphicon glyphicon-trash", 'confirm' => 'Tem certeza?'];
            $label = "";
            print $this->Form->postLink($label, $url, $attrs);
            break;
        case 'edit': $attrs = ['class' => "btn btn-warning {$size} glyphicon glyphicon-edit"];
            $label = "";
            break;
        case 'add': $attrs = ['class' => "btn btn-success {$size} glyphicon glyphicon-plus btn-xs"];
            $label = "";
            if (empty($url)) {
                $url = ['action' => 'add'];
            }
            break;
    }
    ?>
    <?php if (!empty($url) && $template != 'delete'): ?>
        <?php $label = !empty($label) ? $label : ""; ?>
        <?= $this->Html->link($label, $url, $attrs); ?>
    <?php endif; ?>
<?php endif; ?>

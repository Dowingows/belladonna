
<p><?php $this->element('actions', ['template' => 'add']); ?></p>
<h1>Áreas</h1>
<?= $this->element('breadcrumb'); ?>

<?= $this->element('actions', ['template' => 'delete', 'url' => ['action' => "delete", $area->id]]) ?>
<?= $this->element('actions', ['template' => 'edit', 'url' => ['action' => "edit", $area->id]]) ?>
<br/>
<br/>
<?= $this->Panel->start(['icon' => 'glyphicon glyphicon-th-list', 'label' => 'Detalhes']) ?>
<table class="table table-bordered">
    <tbody>
        <tr>
            <td>Área Pai</td>

            <td>
                <?php if (isset($area->parent)): ?>
                    <?= $area->parent->controller_label ?>
                <?php endif; ?>
            </td>
        </tr>
        <tr>
            <td>Controller</td>
            <td><?= $area->controller ?></td>
        </tr>
        <tr>
            <td>Controller Label</td>
            <td><?= $area->controller_label ?></td>
        </tr>
        <tr>
            <td>Abstrato?</td>
            <td><?=  $this->Frontend->formatBool($area->abstract) ?></td>
        </tr>   
        <tr>
            <td>Áreas Filhas</td>
            <?php

            function get_name_children($key) {
                return $key['controller'] . " => " . $key['controller_label'];
            } ?>
            <td><?= implode(", ", array_map('get_name_children', $area->children)) ?></td>
        </tr>   
        <tr>
            <td>Ações (Mostrar) </td>
                <?php
                function get_name($key) {
                    return $key['action'] . " => " . $key['action_label'] . "({$key['appear']})";
                } ?>
            <td>
                <?php if (!empty($area->actions)): ?>
                <?php $str = str_replace('1', '<i class="glyphicon glyphicon-ok"></i>', implode(", ", array_map('get_name', $area->actions)));?>
                <?php $str = str_replace('0', '<i class="glyphicon glyphicon-remove"></i>', $str);?>
                    <?= $str ?>
                <?php else: ?>
                                    Não possui ações
                <?php endif; ?>
            </td>
        </tr>  
    </tbody>
</table>
<?= $this->Panel->end(); ?>
          
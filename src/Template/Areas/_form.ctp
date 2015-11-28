<?php

$actionsInput = function($key = 0) {

    $model = 'actions.' . $key;

    $output = '<div id="' . str_replace('.', '', $model) . '" class="row">';

    $output .= $this->Frontend->wrapDiv(['class' => 'col-lg-4'], $this->Form->input($model . '.action'));
    $output .= $this->Frontend->wrapDiv(['class' => 'col-lg-4'], $this->Form->input($model . '.action_label')) . "";
    $output .= $this->Frontend->wrapDiv(['class' => 'col-lg-2'], $this->Form->label('Mostrar') . $this->Form->input($model . '.appear', ['type' => 'checkbox', 'label' => false]));

    $output .= $this->Frontend->wrapDiv(['class' => 'col-lg-2'], $this->Html->link('Remover', '#', ['onclick' => "removeAction(event,{$key})", 'class' => 'btn btn-default']));

    $output .= "</div>";

    return $output;
}
?>


<p><?php $this->element('actions', ['template' => 'add']); ?></p>
<div class="title">Áreas</div>
<?= $this->element('breadcrumb'); ?>
<?= $this->Panel->start(['icon' => 'glyphicon glyphicon-th', 'label' => 'Formulário']) ?>
<?= $this->Form->create($area, ['novalidate']) ?>
<fieldset>
    <legend>Área</legend>
    <?= $this->Frontend->wrapDiv(['class' => 'col-lg-3'], $this->Form->input('parent_id', ['label' => 'Área Pai', 'options' => $areasList, 'empty' => '---'])) ?>
    <?= $this->Frontend->wrapDiv(['class' => 'col-lg-3'], ($this->Form->input('controller'))) ?>
    <?= $this->Frontend->wrapDiv(['class' => 'col-lg-4'], $this->Form->input('controller_label')) ?>
    <?= $this->Frontend->wrapDiv(['class' => 'col-lg-2'], $this->Form->label('Abstrata') . $this->Form->input('abstract', ['label' => false, 'type' => 'checkbox'])) ?>
</fieldset>
<div id="areaAcoes">
    <fieldset>
        <legend><?= __('Ações') ?></legend>
        <div class="container">
            <div class="area-actions">
                <?php $actions = empty($this->request->data['actions']) ? $area->actions : $this->request->data['actions']; ?>
                <?php if (empty($actions)): ?>
                    <?php $actionsInput(); ?>
                <?php else: ?>
                    <?php foreach (array_keys($actions) as $key) : ?>
                        <?= $actionsInput($key) ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <?= $this->Html->link('Adicionar nova', '#', ['id' => 'newAction', 'class' => 'btn btn-success']) ?>
        </div>
    </fieldset>
</div>
<br/>
<?= $this->Form->button(__('Salvar')); ?>
<?= $this->Form->end() ?>
<?= $this->Panel->end(); ?>


<script>
    const HTML_AREAS_ACTIONS = '<?= $actionsInput(); ?>';
    AUTO_INCREMENT = $('.area-actions').length;
</script>

<?= $this->Html->script(['actions-add']); ?>


<script>
    $('#abstract').on('change',function(){
        if($('#abstract:checked').val()){
            $('#areaAcoes').hide();
        }else{
            $('#areaAcoes').show();
        }
    }).trigger('change');
   
</script>



<?= $this->Html->css(['form'])?>
<p><?php $this->element('actions', ['template' => 'add']); ?></p>
<h1>Perfís de Usuário</h1>
<?= $this->element('breadcrumb'); ?>
<?= $this->Panel->start(['icon' => 'glyphicon glyphicon-th', 'label' => 'Formulário']) ?>
<?= $this->Form->create($profile,['novalidate']) ?>
<fieldset style="padding-bottom: 10px;">
    <legend><?= __('Perfís') ?></legend>
    <?= $this->Form->input('name') ?>        
    
    <?php
        if (!empty($actions)) {
            foreach ($actions as $group => $groupOptions) {
                $legend = $this->Html->tag('legend', $group,['class'=>'title-min']);

                $checkboxes = $this->Form->select('actions._ids', $groupOptions, [
                    'multiple' => 'checkbox',
                    'hiddenField' => false
                ]);
                $fieldset = $this->Html->tag('fieldset', $legend . $checkboxes);
                echo $this->Html->tag('div', $fieldset, ['class' => 'col col-lg-2']);
            }
        }
    ?>  
</fieldset>
<?= $this->Form->button(__('Salvar')); ?>
<?= $this->Form->end() ?>
<?= $this->Panel->end(); ?>
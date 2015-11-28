<?= $this->Html->css(['form'])?>
<h1>Perfís de Usuário</h1>
<?= $this->element('breadcrumb'); ?>
<?= $this->Panel->start(['icon' => 'glyphicon glyphicon-th', 'label' => 'Formulário']) ?>

<?= $this->Form->create($user, ['novalidate']) ?>
<fieldset>
    <legend><?= __('Dados do usuário') ?></legend>
    
    <?= $this->Frontend->wrapDiv(['class' => 'col-lg-4'],$this->Form->input('name')); ?>
    <?= $this->Frontend->wrapDiv(['class' => 'col-lg-4'],$this->Form->input('email')); ?>
    <?= $this->Frontend->wrapDiv(['class' => 'col-lg-4'],$this->Form->input('profile_id', ['label' => 'Perfil', 'type' => 'select', 'required' => true, 'empty' => '---'])); ?>
     <legend><?= __('Senha') ?></legend>
    <?= $this->Frontend->wrapDiv(['class' => 'col-lg-4'],$this->Form->input('currentPassword',['label'=>'Senha atual','type'=>'password','value'=>''])); ?>
    <?= $this->Frontend->wrapDiv(['class' => 'col-lg-4'],$this->Form->input('newPassword',['label'=>'Nova senha','type'=>'password','value'=>''])); ?>
    <?= $this->Frontend->wrapDiv(['class' => 'col-lg-4'],$this->Form->input('newPasswordConfirm',['label'=>'Confirme a nova senha','type'=>'password','value'=>''])); ?>
</fieldset>
<?= $this->Panel->end(); ?>
<?= $this->Form->button(__('Salvar')); ?>
<?= $this->Form->end() ?>
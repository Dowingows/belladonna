<?= $this->Html->css(['form'])?>
<p><?php $this->element('actions', ['template' => 'add']); ?></p>
<h1>Áreas</h1>
<?= $this->element('breadcrumb'); ?>

<?= $this->element('actions', ['template' => 'delete', 'url' => ['action' => "delete", $profile->id]]) ?>
<?= $this->element('actions', ['template' => 'edit', 'url' => ['action' => "edit", $profile->id]]) ?>
<br/>
<br/>
<?= $this->Panel->start(['icon' => 'glyphicon glyphicon-th-list', 'label' => 'Detalhes']) ?>
<h3>Perfíl</h3>
<table class="table table-bordered">
    <tbody>
        <tr>
            <td>Nome: </td>
            <td>
                <?= $profile->name?>
            </td>
        </tr>
    </tbody>
</table>

<h3>Ações </h3>
<h5>(Nome da ação | Mostrar no menu?)</h5>
    <div class="row">
<?php if(!empty($actions)): ?>
        <?php foreach($actions  as $area) :?>
        <div class="col-lg-2">
            <fieldset>
                <legend class="title-min"><?= $area['group_name'] ?></legend>
                <table class="table table-bordered table-striped">
                    <tbody>
                        <?php foreach($area['actions'] as $action): ?>
                        <tr>
                            <td><?= $action['action_label']?> (<?= $action['action']?>)</td>
                            <td><?= $this->Frontend->formatBool($action['appear']); ?></td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </fieldset>
        </div>
        <?php endforeach;?>
<?php else: ?>
        <div class="col-lg-2">
            <table class="table">
            <tr>
                <td>Sem ações</td>
            </tr>
        </table>
        </div>
<?php endif;?>
    </div>

<?= $this->Panel->end(); ?>
          
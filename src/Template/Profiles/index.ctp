<p><?php $this->element('actions', ['template' => 'add']); ?></p>
<h1>Perfís de Usuário</h1>
<?= $this->element('breadcrumb'); ?>
<?= $this->element('actions', ['template' => 'add']) ?>
<br/>
<br/>
<?= $this->Panel->start(['icon' => 'glyphicon glyphicon-th', 'label' => 'Dados']) ?>
<table class="table table-striped">
    <thead>
        <th>Nome</th>
        <th>Criado em</th>
        <th>Modificado em</th>
        <th>Ações</th>
    </thead>

    <?php foreach ($profiles as $profile): ?>
        <tr>
            <td>
                <?= $this->Html->link($profile->name, ['action' => 'view', $profile->id]) ?>
            </td>

            <td><?= $profile->created->format("d/m/Y H:i"); ?></td>
            <td>
                <?= $profile->modified->format("d/m/Y H:i"); ?>
            </td>
            <td>        

                <?= $this->element('actions', ['template' => 'edit', 'url' => ['action' => "edit", $profile->id], 'size' => 'btn-xs']) ?>
                <?= $this->element('actions', ['template' => 'delete', 'url' => ['action' => "delete", $profile->id], 'size' => 'btn-xs']) ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>


<?= $this->Panel->end(); ?>
<?= $this->element('paginate'); ?>
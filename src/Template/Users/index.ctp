<p><?php $this->element('actions', ['template' => 'add']); ?></p>
<h1>Usuários</h1>
<?= $this->element('breadcrumb'); ?>
<?= $this->element('actions', ['template' => 'add']) ?>
<br/>
<br/>
<?= $this->Panel->start(['icon' => 'glyphicon glyphicon-th', 'label' => 'Dados']) ?>
<table class="table table-striped">
    <thead>
        <th>Email</th>
        <th>Nome</th>
        <th>Perfil</th>
        <th>Criado</th>
        <th>Ações</th>
    </thead>
    <tbody>
    <?php foreach ($users as $user): ?>
        <tr>
            <td><?= $this->Html->link($user->email, ['action' => 'view', $user->id]) ?></td>
            <td><?= $user->name ?></td>      
            <td><?= $user->profile->name ?></td>      
            <td><?= $user->created->format("d/m/Y H:i"); ?></td>
           
            <td>
               <?= $this->element('actions', ['template' => 'edit', 'url' => ['action' => "edit", $user->id], 'size' => 'btn-xs']) ?>
                <?= $this->element('actions', ['template' => 'delete', 'url' => ['action' => "delete", $user->id], 'size' => 'btn-xs']) ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>


<?= $this->Panel->end(); ?>
<?= $this->element('paginate'); ?>
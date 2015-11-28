<p><?php $this->element('actions', ['template' => 'add']); ?></p>

<div class="title">Áreas </div>
<?= $this->element('breadcrumb'); ?>

<?= $this->element('actions', ['template' => 'add']) ?>
<br/>
<br/>
<?= $this->Panel->start(['icon' => 'glyphicon glyphicon-th', 'label' => 'Dados']) ?>
<table class="table table-striped">
    <thead>
    <th>Controller</th>
    <th>Controller Label</th>
    <th>Abstrata?</th>
    <th>Ações</th>
    <thead>
    <tbody>
        <?php foreach ($areas as $area): ?>
            <tr>
                <td>
                    <?= $this->Html->link($area->controller, ['action' => 'view', $area->id]) ?>
                </td>
                <td>
                    <?= $area->controller_label ?>
                </td>
                <td>
                    <?= $this->Frontend->formatBool($area->abstract) ?>
                </td>
                <td>
                    <?= $this->element('actions', ['template' => 'edit', 'url' => ['action' => "edit", $area->id], 'size' => 'btn-xs']) ?>
                    <?= $this->element('actions', ['template' => 'delete', 'url' => ['action' => "delete", $area->id], 'size' => 'btn-xs']) ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?= $this->Panel->end(); ?>
</div>
</div>

<?= $this->element('paginate'); ?>




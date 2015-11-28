<?php
    $action = ($this->request->params['action'] == 'index') ? false : true; 
?>
<ol class="breadcrumb">
    <li><?= $this->Html->link('Home', ['controller' => 'Pages', 'action' => 'display']) ?></li>
    <?php if ($action) : ?>
            <li><?= $this->Html->link($this->request->params['controller'], ['controller' => $this->request->params['controller'], 'action' => 'index']) ?></li>
            <li class="active"><?= $this->request->params['action'] ?></li>
    <?php else:?>
            <li><?= $this->request->params['controller']?></li>           
    <?php endif; ?>
</ol>
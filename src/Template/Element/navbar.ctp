<?php $this->start('navbar-inverse'); ?>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <!--<a class="navbar-brand" href="#"></a>-->
            <?= $this->Html->link($AppTitle, ['controller' => 'Pages', 'action' => 'display'], ['class' => 'navbar-brand']); ?>
        </div>

        <div id="navbar" class="collapse navbar-collapse">
            <?= $this->Menu->show(); ?>
        </div><!--/.nav-collapse -->
    </div>
</nav>
<?php $this->end(); ?>
<?php $this->start('navbar-default'); ?>
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <!--<a class="navbar-brand" href="#"></a>-->
            <?= $this->Html->link($AppTitle, ['controller' => 'Pages', 'action' => 'display'], ['class' => 'navbar-brand']); ?>
        </div>

        <div id="navbar" class="collapse navbar-collapse">
            <?= $this->Menu->show(); ?>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="glyphicon glyphicon-user" ></i> <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li>
                            <?= $this->Html->link('<i class="glyphicon glyphicon-folder-open"></i> Meus Dados', ['controller' => 'Users', 'action' => 'editAccount'], ['escape' => false]); ?>                               
                            
                        </li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#" onclick="return false">Último Login:</a></li>
                        <li><a href="#" onclick="return false"><i class="glyphicon glyphicon-time"></i> 10:42</a></li>
                        <li><a href="#" onclick="return false"><i class="glyphicon glyphicon-calendar"></i> 07/10/2025</a></li>    
                        <li role="separator" class="divider"></li>
                        <li>
                            <?= $this->Html->link('<i class="glyphicon glyphicon-log-out"></i> Sair', ['controller' => 'Users', 'action' => 'logout'], ['escape' => false]); ?>                               
                        </li>
                    </ul>
                </li>
            </ul>
        </div><!--/.nav-collapse -->

    </div>
</nav>
<?php
$this->end();

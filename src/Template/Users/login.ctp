<div class="form-top">
    <div class="form-top-left">
        <h3>Entrar</h3>
        <p>Entre com seu usuário e senha para entrar:</p>
    </div>
    <div class="form-top-right">
        <i class="fa fa-lock"></i>
    </div>
</div>
<div class="form-bottom">
<!--    <div class="alert alert-danger" role="alert">
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <span class="sr-only">Error:</span>
        Enter a valid email address
    </div>-->

    <?= $this->Flash->render('auth', ['element' => 'warning']) ?>
    <?= $this->Flash->render() ?> 


    <?= $this->Form->create('', ['class'=>'login-form','novalidate']) ?>

    <?= $this->Form->input('email',['label'=>false,'type'=>'text','placeholder'=>'Usuário...','class'=>'form-username form-control']) ?>
    <?= $this->Form->input('password', ['label'=>false,'placeholder'=>'Senha...','class'=>'form-password form-control']) ?>

    <?= $this->Form->button(__('Login')); ?>
    <?= $this->Form->end() ?>
</div>


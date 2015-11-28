
<!DOCTYPE html>
<html charset="utf-8">
    <head>

        <?= $this->Html->charset() ?>

        <title>
            <?= $this->fetch('title') ?>
        </title>
        <?= $this->Html->meta('icon') ?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <?= $this->Html->css(['bootstrap/bootstrap.min.css', 'custom']); ?>
        <?= $this->Html->script(['lib/jquery2.1.4.min', 'lib/bootstrap.min']) ?>


        <?= $this->fetch('meta') ?>
        <?= $this->fetch('css') ?>
        <?= $this->fetch('script') ?>
    </head>



</head>

<body>

    <?= $this->element('navbar'); ?>
    <?= $this->fetch('navbar-default'); ?>

    <div class="container">

        <?= $this->Flash->render() ?>
        <div class="row">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <?= $this->fetch('content') ?>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->



</body>
</html>

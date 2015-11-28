<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Belladona</title>

        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <?= $this->Html->css(['bootstrap/bootstrap.min.css', 'font-awesome/css/font-awesome.min']); ?>
        <?= $this->Html->css(['login/form-elements', 'login/style']); ?>
        
        <?= $this->Html->meta('favicon.ico', 'ico/favicon.png',['type'=>'ico']);?>
        <!-- Favicon and touch icons -->
<!--        <link rel="shortcut icon" href="assets/ico/favicon.png">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="/ico/apple-touch-icon-57-precomposed.png">-->

    </head>

    <body>

        <!-- Top content -->
        <div class="top-content">

            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                            <h1><strong>Belladonna</strong> Login</h1>
                            <div class="description">

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                               <?= $this->fetch('content') ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 social-login">
                        </div>
                    </div>
                </div>
            </div>

        </div>


        <!-- Javascript -->

        <?= $this->Html->script(['lib/jquery2.1.4.min', 'lib/bootstrap.min',
            'scripts', 'lib/jquery.backstretch.min']) ?>
    </body>

</html>
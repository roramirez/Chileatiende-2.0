<!DOCTYPE html>
<html lang="es">
<head>
    <base href="<?=url('')?>" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?=csrf_token()?>">
    <title>ChileAtiende - <?=$title?></title>

    <!-- Bootstrap -->
    <link href="css/app.css" rel="stylesheet">

</head>
<body>
<div id="app">
    <header>
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                            data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">ChileAtiende</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="">Inicio</a></li>
                        <li><a href="#">¿Qué es ChileAtiende?</a></li>
                        <li><a href="#">Centro de Ayuda</a></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
    </header>

    <main>
        <?=$content?>
    </main>

    <?=view('chunks/footer')?>
</div>

<script src="js/app.js"></script>
</body>
</html>
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
    <header class="home">
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
                    <a class="navbar-brand" href=""><img src="images/logo.svg" alt="ChileAtiende" /></a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#">¿Qué es ChileAtiende?</a></li>
                        <li><a href="#">Centro de Ayuda</a></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>

        <div class="main">
            <div class="container">
                <div class="row">
                    <div class="col-sm-7">
                        <h2>¡Hola! Estas en ChileAtiende</h2>
                        <h3>Guía de Trámites y Servicios del Estado</h3>
                    </div>
                    <div class="col-sm-5">
                        <div class="claveunica">
                            <div class="media">
                                <div class="media-left">
                                    <img src="images/logo-claveunica.svg"/>
                                </div>
                                <div class="media-body">
                                    <p>Con tu <a href="#">Clave Única</a>, accede a los trámites del Estado desde
                                        cualquier lugar.</p>
                                    <a class="btn">Accede a mi ChileAtiende →</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <label>¿Qué trámite o servicio buscas?</label>
                <form action="search">
                    <search id="search" class="search" name="query" value=""></search>
                </form>
                <h4>Lo mas buscado</h4>
                <ul class="search-list">
                    <?php foreach($suggestions as $s):?>
                        <li><a href="search?query=<?=htmlspecialchars($s->query)?>"><?=htmlspecialchars($s->query)?></a></li>
                    <?php endforeach ?>
                </ul>
            </div>
        </div>
    </header>

    <main>
        <?=$content?>
    </main>

    <?=view('chunks/footer')?>
</div>

<script src="js/app.js"></script>
</body>
</html>
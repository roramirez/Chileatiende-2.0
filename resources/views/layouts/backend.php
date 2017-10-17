<?=view('chunks/head', ['title' => $title])?>
<div id="app">
    <header class="default">
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
                    <a class="navbar-brand" href="">
                        <img class="gob" src="images/gob.svg" alt="Gobierno de Chile" />
                        <img src="images/logo.svg" alt="ChileAtiende" />
                    </a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a><?= Auth::user()->name ?></a></li>
                        <li><a><?=\Carbon\Carbon::now()->formatLocalized('%A, %e de %B')?></a></li>
                        <li><a href="" target="_blank">Ver portada</a></li>
                        <li>
                            <a href="<?= route('logout') ?>" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Salir</a>
                            <form id="logout-form" action="<?= route('logout') ?>" method="POST" style="display: none;">
                                <?= csrf_field() ?>
                            </form>
                        </li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
    </header>

    <main>
        <div id="backend">
            <div class="container">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="sidebar">
                            <div class="panel panel-default">
                                <div class="panel-heading">Menu Principal</div>
                                <div class="panel-body">
                                    <ul>
                                        <li><a>Mis datos</a></li>
                                        <li><a>Panel de control</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">Trámites y servicios</div>
                                <div class="panel-body">
                                    <ul>
                                        <li><a href="backend/fichas/create">Agregar ficha</a></li>
                                        <li><a href="backend/fichas">Ver fichas</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">Administración</div>
                                <div class="panel-body">
                                    <ul>
                                        <li><a href="backend/oficinas">Oficinas</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-9">
                        <?php if(session()->has('status')):?>
                            <div class="alert alert-success">
                                <?=session('status')?>
                            </div>
                        <?php endif ?>
                        <div><?= $content ?></div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?=view('chunks/footer')?>
</div>
<?=view('chunks/foot')?>
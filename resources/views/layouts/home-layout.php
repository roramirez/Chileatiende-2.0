<?=view('chunks/head', ['title' => $title])?>
<div id="app">
    <header class="home">
        <?= view('chunks/siteselector') ?>
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="">
                        <img class="gob hidden-xs" src="images/gob.svg" alt="Gobierno de Chile" />
                        <img src="images/logo.svg" alt="ChileAtiende" class="hidden-xs" />
                        <img src="images/logo-color.svg" alt="ChileAtiende" class="visible-xs img-responsive logo-mobile" />
                    </a>
                    <div class="visible-xs-block text-right">
                        <mobile-menu></mobile-menu>
                    </div>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="/que-es-chileatiende">¿Qué es ChileAtiende?</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                Centro de Ayuda <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu help-menu">
                                <li>
                                    <a href="/ayuda/preguntas-frecuentes" class="help-card" title="Ir a preguntas frecuentes">
                                        <div class="media <?= Request::path() == 'ayuda/preguntas-frecuentes' ? 'active' : '' ?>">
                                            <div class="media-left">
                                                <i class="material-icons">help</i>
                                            </div>
                                            <div class="media-body">
                                                <div class="media-heading">Preguntas Frecuentes</div>
                                                <p>Revisa la lista de preguntas frecuentes.</p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="/ayuda/sucursales" class="help-card" title="ir a sucursales">
                                        <div class="media <?= Request::path() == 'ayuda/sucursales' ? 'active' : '' ?>">
                                            <div class="media-left">
                                                <i class="material-icons">store</i>
                                            </div>
                                            <div class="media-body">
                                                <div class="media-heading">Sucursales</div>
                                                <p>Busca tu sucursal de ChileAtiende más cercana.</p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="/ayuda/atencion-telefonica" class="help-card" title="Ir a atención telefónica">
                                        <div class="media <?= Request::path() == 'ayuda/atencion-telefonica' ? 'active' : '' ?>">
                                            <div class="media-left">
                                                <i class="material-icons">perm_phone_msg</i>
                                            </div>
                                            <div class="media-body">
                                                <div class="media-heading">Atención Telefónica</div>
                                                <p>Aprende a utilizar el servicio de telefónica 101.</p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="/ayuda/oficinas-moviles" class="help-card">
                                        <div class="media <?= Request::path() == 'ayuda/oficinas-moviles' ? 'active' : '' ?>">
                                            <div class="media-left">
                                                <i class="material-icons">directions_bus</i>
                                            </div>
                                            <div class="media-body">
                                                <div class="media-heading">Oficinas Móviles</div>
                                                <p>Conoce la ubicación de nuestras oficinas móviles.</p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>

        <div class="main">
            <div class="container">
                <div class="row">
                    <div class="col-sm-7">
                        <h2>¡Hola! Estás en ChileAtiende <?=Session::get('skin')?></h2>
                        <h3>Guía de Trámites y Servicios del Estado</h3>
                    </div>
                    <div class="col-sm-5">
                        <div class="claveunica hidden-xs">
                            <div class="media">
                                <div class="media-left">
                                    <img src="images/logo-claveunica.svg"/>
                                </div>
                                <div class="media-body">
                                    <p>Con tu <a href="#">Clave Única</a>, accede a los trámites del Estado desde
                                        cualquier lugar.</p>
                                    <a class="btn" href="login/claveunica">Accede a mi ChileAtiende →</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <label>¿Qué trámite o servicio buscas?</label>
                <form action="buscar">
                    <search id="search" class="search" name="query" value=""></search>
                </form>
                <div class="search-list-container">
                    <h4>Lo más buscado</h4>
                    <ul class="search-list searchtags-mask">
                        <?php foreach($suggestions as $s):?>
                            <li><a href="buscar?query=<?=htmlspecialchars($s->query)?>"><?=htmlspecialchars($s->query)?></a></li>
                        <?php endforeach ?>
                    </ul>
                </div>
            </div>
        </div>
    </header>

    <main>
        <?=$content?>
    </main>
    <?=view('chunks/banner')?>
    <div class="modal fade claveunica-modal" id="claveunica-modal" class="" tabindex="-1" role="dialog" aria-labelledby="claveunica-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <!-- <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Sección en desarrollo</h4>
                </div> -->
                <div class="modal-body">
                    <h4>Sección en Desarrollo</h4>
                    <p>Portal Chileatiende en etapa Beta</p>
                </div>
                <div class="text-right">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Volver</button>
                </div>
            </div>
        </div>
    </div>
    <?=view('chunks/footer')?>
</div>
<?=view('chunks/foot')?>
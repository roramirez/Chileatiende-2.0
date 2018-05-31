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
                <mobile-menu :user="<?= e(Auth::check() ? Auth::user() : 'null') ?>"></mobile-menu>
            </div>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <?php if(@$skin == 'exterior'):?>
                    <li><a href="/que-es-chileatiende?skin=exterior">¿Qué es ChileAtiende en el exterior?</a></li>
                <?php else: ?>
                <li><a href="/que-es-chileatiende">¿Qué es ChileAtiende?</a></li>
                <?php endif ?>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        Centro de Ayuda <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu help-menu">
                        <li>
                            <a href="/ayuda/preguntas-frecuentes<?=@$skin == 'exterior' ? '?skin=exterior':''?>" class="help-card" title="Ir a preguntas frecuentes">
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
                            <a href="/ayuda/contacto" class="help-card" title="Contactenos">
                                <div class="media">
                                    <div class="media-left">
                                        <i class="material-icons">mail</i>
                                    </div>
                                    <div class="media-body">
                                        <div class="media-heading">Contactenos</div>
                                        <p>Ir a formulario de contacto</p>
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
                <?php if(Auth::check()):?>
                    <li class="dropdown">
                        <a href="#" class="mcha-btn dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <img src="images/clave-logo.svg" alt="Logo Claveúnica"> Mi Chileatiende <span class="caret"></span>
                        </a>
                        <ul class="mcha-dropdown dropdown-menu">
                            <li>Bienvenido/a <?=Auth::user()->first_name?></li>
                            <li>
                                <a href="perfil">
                                    <i class="material-icons">person</i>
                                    Perfil
                                </a>
                            </li>
                            <li>
                                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="material-icons">power_settings_new</i>
                                    Cerrar Sesión
                                </a>
                                <form id="logout-form" action="logout" method="POST" style="display: none;">
                                    <?= csrf_field() ?>
                                </form>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="notificaciones" class="notifications">
                            <i class="material-icons">notifications</i>
                            <span class="notification-badge">
                                <?=Auth::user()->notifications()->where('read',0)->count()?>
                            </span>
                        </a>
                    </li>
                <?php else: ?>
                    <?php /*
                    <li><a href="mi-chileatiende" class="mcha-btn">
                            <img src="images/clave-logo.svg" alt="Logo Claveúnica">
                            Accede a Mi ChileAtiende</a>
                    </li>
                    */ ?>
                <?php endif ?>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

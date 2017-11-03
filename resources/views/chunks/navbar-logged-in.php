<?php if(Auth::check()):?>
    <nav class="navbar navbar-logged-in">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Mi ChileAtiende</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">


                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#"><img src="images/mail.svg" alt="Notificaciones" /></a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Bienvenido/a <?=Auth::user()->first_name?> <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="<?= route('logout') ?>" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar Sesión</a>
                                <form id="logout-form" action="<?= route('logout') ?>" method="POST" style="display: none;">
                                    <?= csrf_field() ?>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
<?php endif ?>
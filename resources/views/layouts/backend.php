<!DOCTYPE html>
<html lang="es">
<head>
    <base href="<?=url('')?>" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?=csrf_token()?>">
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico"  />
    <title>ChileAtiende - <?=$title?></title>

    <!-- Bootstrap -->
    <link href="css/backend.css" rel="stylesheet">

</head>
<body>
<div id="app">
    <header class="default backend-header">
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
                        <img src="images/logo-color.svg" alt="ChileAtiende" />
                    </a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a><?= Auth::user()->name ?></a></li>
                        <li><span></span></li>
                        <li><a href="" class="view-site-button" target="_blank">Ir al sitio</a></li>
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
                    <div class="row">
                        <div class="col-md-12">
                            <div class="text-right">
                                <div class="date">
                                    <i class="material-icons">date_range</i>
                                    <span v-text="moment().format('dddd, D [de] MMMM')"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="sidebar">
                            <div class="sidebar-buttons">
                                <a  href="backend/perfil" class="sidebar-btn <?= Request::path() == 'backend/perfil' ? 'active' : '' ?>">
                                    <i class="material-icons">person</i> Mis datos
                                </a>
                            </div>

                            <?php if(Auth::user()->can('view', \App\Page::class)):?>
                                <div class="sidebar-buttons">
                                    <div class="heading">Trámites y servicios</div>
                                    <a href="backend/fichas" class="sidebar-btn <?= Request::path() == 'backend/fichas' ? 'active' : '' ?>">
                                        <i class="material-icons">visibility</i>
                                        Ver fichas
                                    </a>
                                    <a href="backend/fichas/create" class="sidebar-btn <?= Request::path() == 'backend/fichas/create' ? 'active' : '' ?>">
                                        <i class="material-icons">note_add</i>
                                        Agregar ficha
                                    </a>
                                    <?php if(Auth::user()->can('updateFeatured', \App\Page::class)):?>
                                        <a href="backend/fichas/featured" class="sidebar-btn <?= Request::path() == 'backend/fichas/featured' ? 'active' : '' ?>">
                                            <i class="material-icons">visibility</i> Ver destacadas
                                        </a>
                                    <?php endif ?>
                                </div>
                            <?php endif ?>
                            <?php if(Auth::user()->can('view', \App\Institution::class)):?>
                                <div class="sidebar-buttons">
                                    <div class="heading">Instituciones</div>
                                    <a href="backend/instituciones/create" class="sidebar-btn <?= Request::path() == 'backend/instituciones/create' ? 'active' : '' ?>">
                                        <i class="material-icons">note_add</i>
                                        Agregar institución
                                    </a>
                                    <a href="backend/instituciones" class="sidebar-btn <?= Request::path() == 'backend/instituciones' ? 'active' : '' ?>">
                                        <i class="material-icons">visibility</i>
                                        Ver instituciones
                                    </a>
                                </div>
                            <?php endif ?>
                            <?php if(Auth::user()->can('view', \App\Ministry::class)):?>
                                <div class="sidebar-buttons">
                                    <div class="heading">Ministerios</div>
                                    <a href="backend/ministerios/create" class="sidebar-btn <?= Request::path() == 'backend/ministerios/create' ? 'active' : '' ?>">
                                        <i class="material-icons">note_add</i>
                                        Agregar ministerio
                                    </a>
                                    <a href="backend/ministerios" class="sidebar-btn <?= Request::path() == 'backend/ministerios' ? 'active' : '' ?>">
                                        <i class="material-icons">visibility</i>
                                        Ver ministerios
                                    </a>
                                </div>
                            <?php endif ?>
                            <?php if(Auth::user()->can('view', \App\Office::class)):?>
                                <div class="sidebar-buttons">
                                    <div class="heading">Oficinas</div>
                                    <a href="backend/oficinas" class="sidebar-btn <?= Request::path() == 'backend/oficinas' ? 'active' : '' ?>">
                                        <i class="material-icons">business</i>
                                        Oficinas
                                    </a>
                                </div>
                            <?php endif ?>
                            <?php if(Auth::user()->can('view', \App\Content::class)):?>
                                <div class="sidebar-buttons">
                                    <div class="heading">Contenidos</div>
                                    <a href="backend/contenidos/create" class="sidebar-btn <?= Request::path() == 'backend/contenidos/create' ? 'active' : '' ?>">
                                        <i class="material-icons">note_add</i>
                                        Agregar Contenidos
                                    </a>
                                    <a href="backend/contenidos" class="sidebar-btn <?= Request::path() == 'backend/contenidos' ? 'active' : '' ?>">
                                        <i class="material-icons">visibility</i>
                                        Ver Contenidos
                                    </a>
                                </div>
                            <?php endif ?>
                            <?php if(Auth::user()->can('view', \App\User::class)):?>
                                <div class="sidebar-buttons">
                                    <div class="heading">Administración</div>
                                    <?php if(Auth::user()->can('view', \App\User::class)):?>
                                        <a href="backend/usuarios" class="sidebar-btn <?= Request::path() == 'backend/usuarios' ? 'active' : '' ?>">
                                            <i class="material-icons">person</i>
                                            Usuarios
                                        </a>
                                    <?php endif ?>
                                    <?php if(Auth::user()->can('view', \App\Category::class)):?>
                                        <a href="backend/categorias" class="sidebar-btn <?= Request::path() == 'backend/categorias' ? 'active' : '' ?>">
                                            <i class="material-icons">format_list_bulleted</i>
                                            Categorías
                                        </a>
                                    <?php endif ?>
                                    <?php if(Auth::user()->can('create', \App\Notification::class)):?>
                                        <a href="backend/notificaciones/create" class="sidebar-btn <?= Request::path() == 'backend/notificaciones' ? 'active' : '' ?>">
                                            <i class="material-icons">notifications</i>
                                            Notificaciones
                                        </a>
                                    <?php endif ?>
                                </div>
                            <?php endif ?>
                            <div class="sidebar-buttons">
                                <div class="heading">Manual</div>
                                <a href="/manual-backend/" class="sidebar-btn">
                                    <i class="material-icons">chrome_reader_mode</i>
                                    Manual del CMS
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-9">
                        <?php if(session()->has('status')):?>
                            <div class="alert alert-success">
                                <?=session('status')?>
                            </div>
                        <?php endif ?>
                        <div class="page-title">
                            <h2>
                                <i class="material-icons"><?= isset($iconTitle) ? $iconTitle : 'visibility' ?></i>
                                <?= $title ?>
                            </h2>
                            <hr>
                        </div>
                        <div><?= $content ?></div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?=view('chunks/footer')?>
</div>
<script>
    window.baseUrl = "<?=url('')?>";
</script>
<script src="js/backend.js"></script>

</body>
</html>
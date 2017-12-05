<!DOCTYPE html>
<html lang="es">
<head>
    <base href="<?=url('')?>" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?=csrf_token()?>">
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico"  />
    <title>API ChileAtiende - <?=$title?></title>

    <!-- Bootstrap -->
    <link href="css/backend.css" rel="stylesheet">

</head>
<body>
<div id="api-layout">
    <header>
        <div class="container">
            <a href="<?= url('') ?>">
                <img src="images/logo-color.svg" alt="ChileAtiende" class="logo-api" />
            </a>
            <div class="pull-right">
                <h1><a href="/desarrolladores">Interfaz para programadores <span>(API)</span></a></h1>
            </div>
        </div>
    </header>
    <main>
        <div class="container">
            <div class="text-right">
                <div class="policy-link">
                    <i class="material-icons">help</i>
                    <a href="/desarrolladores/politica-de-uso">
                    Políticas de Uso y Términos del Servicio
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="sidebar">
                        <div class="sidebar-buttons">
                            <a  href="/desarrolladores" class="sidebar-btn <?= Request::path() == 'desarrolladores' ? 'active' : '' ?>">
                                API
                            </a>
                        </div>
                        <div class="sidebar-buttons">
                            <a  href="/desarrolladores/fichas" class="sidebar-btn <?= Request::path() == 'desarrolladores/fichas' ? 'active' : '' ?>">
                                <i class="material-icons">insert_drive_file</i> Fichas
                            </a>
                            <div class="child-buttons">
                                <a  href="/desarrolladores/fichas/fichas_obtener" class="sidebar-btn <?= Request::path() == 'desarrolladores/fichas/fichas_obtener' ? 'active' : '' ?>">
                                    Obtener
                                </a>
                                <a  href="/desarrolladores/fichas/fichas_listar" class="sidebar-btn <?= Request::path() == 'desarrolladores/fichas/fichas_listar' ? 'active' : '' ?>">
                                    Listar
                                </a>
                                <a  href="/desarrolladores/fichas/fichas_listarporservicio" class="sidebar-btn <?= Request::path() == 'desarrolladores/fichas/fichas_listarporservicio' ? 'active' : '' ?>">
                                    Listar por Servicio
                                </a>
                            </div>
                        </div>
                        <div class="sidebar-buttons">
                            <a  href="/desarrolladores/servicios" class="sidebar-btn <?= Request::path() == 'desarrolladores/servicios' ? 'active' : '' ?>">
                                <i class="material-icons">insert_drive_file</i> Servicios
                            </a>
                            <div class="child-buttons">
                                <a  href="/desarrolladores/servicios/servicios_obtener" class="sidebar-btn <?= Request::path() == 'desarrolladores/servicios/servicios_obtener' ? 'active' : '' ?>">
                                    Obtener
                                </a>
                                <a  href="/desarrolladores/servicios/servicios_listar" class="sidebar-btn <?= Request::path() == 'desarrolladores/servicios/servicios_listar' ? 'active' : '' ?>">
                                    Listar
                                </a>
                            </div>
                        </div>
                        <div class="sidebar-buttons">
                            <a href="" class="sidebar-btn">
                            <i class="material-icons">vpn_key</i>
                            Obtener API Key
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <?= $content ?>
                    <div class="text-right">
                        Última modificación: 05/12/2017
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
</body>
</html>
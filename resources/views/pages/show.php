<div id="page">
    <div class="container">
        <ol class="breadcrumb">
            <li><a href=""><i class="material-icons">home</i></a></li>
            <li><a href="instituciones/<?= $page->institution->id ?>"><?= $page->institution->name ?></a></li>
            <li><?= $page->title ?></li>
        </ol>
        <div class="row">
            <div class="col-md-4 col-md-push-8">
                <page-nav :page="<?= e(json_encode($page)) ?>" current-url="<?= url()->current() ?>"></page-nav>
            </div>
            <div class="col-md-8 col-md-pull-4">
                <?php if($page->online):?><div class="online">Trámite Online</div><?php endif ?>
                <h3><?= $page->title ?></h3>
                <div class="author"><a href="instituciones/<?=$page->institution->id?>">Información proporcionada por <?= $page->institution->name ?></a></div>
                <div class="updated-at">Actualizado al <?=$page->published_at->formatLocalized('%d de %B, %Y')?></div>
                <hr />
                <h4 id="objective">Descripción</h4>
                <?=App\Twig::render($page->objective)?>
                <br />
                <div class="important">
                    <h4>Marco Legal</h4>
                    <?=$page->legal?>
                </div>

                <?php if($page->details):?>
                <h4 id="details">Detalles</h4>
                <?=App\Twig::render($page->details)?>
                <?php endif ?>

                <h4 id="beneficiaries">¿A quién esta dirigido?</h4>
                <?=App\Twig::render($page->beneficiaries)?>

                <?php if($page->requirements):?>
                <h4 id="requirements">¿Qué necesito para hacer el trámite?</h4>
                <?=App\Twig::render($page->requirements)?>
                <?php endif ?>

                <?php if($page->howto):?>
                <h4 id="howto">¿Cómo y dónde hago el trámite?</h4>
                <div class="howto main-tabs">
                    <ul class="nav nav-tabs" role="tablist" v-select-first-tab>
                        <?php if($page->online):?><li role="presentation"><a href="#online" aria-controls="online" role="tab" data-toggle="tab">Online</a></li><?php endif ?>
                        <?php if($page->office):?><li role="presentation"><a href="#office" aria-controls="office" role="tab" data-toggle="tab">Oficina</a></li><?php endif ?>
                        <?php if($page->phone):?><li role="presentation"><a href="#phone" aria-controls="phone" role="tab" data-toggle="tab">Teléfonico</a></li><?php endif ?>
                        <?php if($page->mail):?><li role="presentation"><a href="#mail" aria-controls="mail" role="tab" data-toggle="tab">Correo</a></li><?php endif ?>
                    </ul>

                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane" id="online">
                            <?=App\Twig::render($page->online_guide)?>
                            <a class="btn btn-online" href="#" data-toggle="modal" data-target="#redirect-modal">Ir al trámite en línea</a>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="office">
                            <?=App\Twig::render($page->office_guide)?>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="phone">
                            <?=App\Twig::render($page->phone_guide)?>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="mail">
                            <?=App\Twig::render($page->mail_guide)?>
                        </div>
                    </div>
                </div>
                <?php endif ?>
            </div>
        </div>
    </div>
    <div id="need-help">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <h3>¿Necesitas Ayuda?</h3>
                    <h4>Llámanos al 101</h4>
                    <p>Lunes a Jueves, de 8:00 a 20:00 hrs.</p>
                    <p>Viernes, de 8:00 a 18:00 hrs.</p>
                </div>
                <div class="col-md-6">
                    <p>Para hacer tu atención más expedita, indícanos este Código de Trámite</p>
                    <div class="page-id-container">
                        <div class="heading">código de trámite</div>
                        <div class="number"><?= $page->master_id ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal modal-redirect fade" id="redirect-modal" class="" tabindex="-1" role="dialog" aria-labelledby="redirect-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"><i class="material-icons">error</i> Aviso de Redirección</h4>
                </div>
                <div class="modal-body">
                    Para realizar tu trámite te redirigiremos al sitio web institucional de <br />
                    <strong><?=$page->institution->name?></strong>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Prefiero seguir en ChileAtiende</button>
                    <a class="btn btn-primary" href="<?=$page->online_url?>">Entendido</a>
                </div>
            </div>
        </div>
    </div>
</div>
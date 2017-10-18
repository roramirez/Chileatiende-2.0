<div id="page">
    <div class="container">
        <ol class="breadcrumb">
            <li><a href=""><i class="material-icons">home</i></a></li>
            <li><a href="instituciones/<?= $page->institution->id ?>"><?= $page->institution->name ?></a></li>
            <li><?= $page->title ?></li>
        </ol>

        <div class="row">
            <div class="col-sm-8">
                <?php if($page->online):?><div class="online">Trámite Online</div><?php endif ?>
                <h3><?= $page->title ?></h3>
                <div class="author"><a href="instituciones/<?=$page->institution->id?>">Información proporcionada por <?= $page->institution->name ?></a></div>
                <div class="updated-at">Actualizado al <?=$page->published_at->formatLocalized('%d de %B, %Y')?></div>
                <hr />
                <div id="page-mobile-nav-container" class="visible-sm visible-xs">
                    <page-mobile-nav :page="<?= e(json_encode($page)) ?>" current-url="<?= url()->current() ?>"></page-mobile-nav>
                    <hr>
                </div>
                <h4 id="objective">Descripción</h4>
                <?=App\Twig::render($page->objective)?>

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
                <h4 id="howto">¿Cómo y donde hago el trámite?</h4>
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
                            <a class="btn btn-online" href="<?=$page->online_url?>" target="_blank">Ir al trámite en línea</a>
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
            <div class="col-sm-4 hidden-sm hidden-xs">
                <div class="sidebar-menu" data-spy="affix" data-offset-top="345" data-offset-bottom="500">
                    <ol type="1" class="nav index">
                        <li><a href="<?= url()->current() ?>#objective" data-target="#objective">Descripción</a></li>
                        <?php if($page->details):?><li><a href="<?= url()->current() ?>#details" data-target="#details">Detalles</a></li><?php endif ?>
                        <li><a href="<?= url()->current() ?>#beneficiaries" data-target="#beneficiaries">¿A quién está dirigido?</a></li>
                        <?php if($page->requirements):?><li><a href="<?= url()->current() ?>#requirements" data-target="#requirements">¿Qué necesito para hacer el trámite?</a></li><?php endif ?>
                        <?php if($page->howto):?><li><a href="<?= url()->current() ?>#howto" data-target="#howto">¿Cómo y dónde hago el trámite? </a></li><?php endif ?>
                    </ol>
                    <?php if($page->online):?>
                        <a class="btn btn-online" href="<?=$page->online_url?>" target="_blank">Ir al trámite en línea</a>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </div>
</div>
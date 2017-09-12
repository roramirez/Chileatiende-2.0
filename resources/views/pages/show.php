<div id="page">
    <div class="container">

        <ol class="breadcrumb">
            <li><a href=""><i class="material-icons">home</i></a></li>
            <li><a href="categories/<?= $page->categories[0]->id ?>"><?= $page->categories[0]->name ?></a></li>
            <li><?= $page->title ?></li>
        </ol>

        <div class="row">
            <div class="col-sm-8">
                <?php if($page->online):?><div class="online">Trámite Online</div><?php endif ?>
                <h3><?= $page->title ?></h3>
                <div class="author">Información proporcionada por <?=$page->institution->name?></div>
                <div class="updated-at">Actualizado al <?=$page->updated_at->formatLocalized('%d de %B, %Y')?></div>

                <hr />

                <h4 id="objective">Descripción</h4>
                <?=$page->objective?>

                <h4 id="beneficiaries">¿A quién esta dirigido?</h4>
                <?=$page->beneficiaries?>

                <h4 id="requirements">¿Qué necesito para hacer el trámite?</h4>
                <?=$page->requirements?>

                <h4 id="howto">¿Cómo y donde hago el trámite?</h4>
                <div class="howto">
                    <ul class="nav nav-tabs" role="tablist" v-select-first-tab>
                        <?php if($page->online):?><li role="presentation"><a href="#online" aria-controls="online" role="tab" data-toggle="tab">Online</a></li><?php endif ?>
                        <?php if($page->office):?><li role="presentation"><a href="#office" aria-controls="office" role="tab" data-toggle="tab">Oficina</a></li><?php endif ?>
                        <?php if($page->phone):?><li role="presentation"><a href="#phone" aria-controls="phone" role="tab" data-toggle="tab">Teléfonico</a></li><?php endif ?>
                        <?php if($page->mail):?><li role="presentation"><a href="#mail" aria-controls="mail" role="tab" data-toggle="tab">Correo</a></li><?php endif ?>
                    </ul>

                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="online">
                            <?=$page->online_guide?>
                            <a class="btn btn-online" href="<?=$page->online_url?>" target="_blank">Ir al trámite en línea</a>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="office">
                            <?=$page->office_guide?>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="phone">
                            <?=$page->phone_guide?>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="mail">
                            <?=$page->mail_guide?>
                        </div>
                    </div>

                </div>

            </div>
            <div class="col-sm-4">
                <div class="sidebar" data-spy="affix" data-offset-top="345">
                    <ol class="index">
                        <li><a href="<?= url()->current() ?>#objective">Descripción</a></li>
                        <li><a href="<?= url()->current() ?>#beneficiaries">¿A quién está dirigido?</a></li>
                        <li><a href="<?= url()->current() ?>#requirements">¿Qué necesito para hacer el trámite?</a></li>
                        <li><a href="<?= url()->current() ?>#howto">¿Cómo y dónde hago el trámite? </a></li>
                    </ol>

                    <a class="btn btn-online" href="<?=$page->online_url?>" target="_blank">Ir al trámite en línea</a>
                </div>
            </div>
        </div>
    </div>
</div>
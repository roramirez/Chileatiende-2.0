<div id="institution">
    <div class="container">

        <ol class="breadcrumb">
            <li><a href=""><i class="material-icons">home</i></a></li>
            <li><a href="instituciones">Instituciones Asociadas</a></li>
            <li class="active"><?=$institution->name?></li>
        </ol>

        <div class="row">
            <div class="col-sm-8">
                <h3><?=$institution->name?></h3>
                <div>Actualizado al <?=Carbon\Carbon::now()->formatLocalized('%d de %B, %Y')?></div>

                <hr />

                <h4>Misión Institucional</h4>
                <div><?=$institution->description?></div>
                <br>
                <h4>Servicios o Beneficios de la Institución (<?=$pages->total()?>)</h4>

                <hr />

                <ul class="pages">
                    <?php foreach($pages as $p):?>
                        <?php $p = $p->publishedVersion() ?>
                        <li>
                            <h5><a href="fichas/<?=$p->guid?>"><?=$p->title?> →</a></h5>
                            <?php if($p->online):?><div class="online">Trámite en Línea</div><?php endif ?>
                            <p><?=str_limit(strip_tags(\App\Twig::strip($p->objective)),200)?></p>
                        </li>
                    <?php endforeach ?>
                </ul>

                <div class="text-center"><?=$pages->links()?></div>

            </div>
            <div class="col-sm-4">
                <div class="sidebar">
                    <h4>Esta institución depende de</h4>
                    <div class="box"><?=$institution->ministry->name?></div>
                </div>
            </div>
        </div>



        
    </div>
</div>

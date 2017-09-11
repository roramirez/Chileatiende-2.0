<div id="search">
    <div class="container">

        <h3>Búsqueda: <?=$query?></h3>
        <div class="total"><?=$results->total()?> Resultados</div>

        <hr />

        <div class="row">
            <div class="col-sm-8">

                <ol class="search-results">
                    <?php foreach($results as $r):?>
                    <li>
                        <div class="author">Publicado por <?=$r->institution->name?></div>
                        <h4><a href="pages/<?=$r->id?>"><?=isset($r->highlight['title']) ? $r->highlight['title'][0] : $r->title?></a></h4>
                        <p><?=isset($r->highlight['objective']) ? $r->highlight['objective'][0] : strip_tags($r->objective)?></p>
                    </li>
                    <?php endforeach ?>
                </ol>

                <?=$results->render()?>
            </div>
        </div>
    </div>
</div>

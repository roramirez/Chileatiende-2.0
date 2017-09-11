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
            <div class="col-sm-4">
                <div class="filter">
                    <h3>Filtrar por</h3>

                    <div class="form-group">
                        <label for="category">Categoría</label>
                        <select id="category" class="form-control">
                            <option value="">Todas</option>
                            <?php foreach ($categories as $c): ?>
                                <option><?= $c->name ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="institution">Institución</label>
                        <select id="institution" class="form-control">
                            <option value="">Todas</option>
                            <?php foreach ($institutions as $c): ?>
                                <option><?= $c->name ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="search">
    <div class="container">

        <h3>Búsqueda: <?=$query?></h3>
        <?php if($category):?><h4>Categoría: <?=$category->name?></h4><?php endif ?>
        <?php if($institution):?><h4>Institución: <?=$institution->name?></h4><?php endif ?>
        <div class="total"><?=$results->total()?> Resultados</div>

        <hr />

        <div class="row">
            <div class="col-md-4 col-md-push-8">
                <div class="filter">
                    <h3 class="heading"><i class="material-icons">filter_list</i> Filtrar por</h3>
                    <a class="filter-collapse btn" role="button" data-toggle="collapse" href="#filterCollapseMobile" aria-expanded="false" aria-controls="filterCollapseMobile">
                        <i class="material-icons">filter_list</i> Filtrar por
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="filterCollapseMobile">
                        <form action="buscar">
                            <input type="hidden" name="query" value="<?=@e($query)?>" />
                            <div class="form-group">
                                <label for="category">Categoría</label>
                                <select id="category" name="category" class="form-control" onchange="this.form.submit()">
                                    <option value="">Todas</option>
                                    <?php foreach ($categories as $c): ?>
                                        <option value="<?=$c->id?>" <?=$category && $category->id == $c->id ? 'selected' : ''?>><?= $c->name ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="institution">Institución</label>
                                <select id="institution" name="institution" class="form-control" onchange="this.form.submit()">
                                    <option value="">Todas</option>
                                    <?php foreach ($institutions as $c): ?>
                                        <option value="<?=$c->id?>" <?=$institution && $institution->id == $c->id ? 'selected' : ''?>><?= $c->name ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
                <hr>
            </div>
            <div class="col-md-8 col-md-pull-4">
                <?php if($results->count()):?>
                    <ol class="search-results">
                        <?php foreach($results as $r):?>
                        <li class="<?=$r->boost > 1 ? 'boosted' : ''?>">
                            <div class="author"><a href="instituciones/<?=$r->institution->id?>">Publicado por <?= $r->institution->name ?></a></div>
                            <h4><a href="fichas/<?=$r->guid?>"><?=isset($r->highlight['title']) ? $r->highlight['title'][0] : $r->title?></a></h4>
                            <?php if($r->online):?><div class="online">Trámite en Línea</div><?php endif ?>
                            <div class="media">
                                <div class="media-left">
                                    <p><?=str_limit(strip_tags(\App\Twig::strip(isset($r->highlight['objective']) ? $r->highlight['objective'][0] : $r->objective),'<em>'),500)?></p>
                                </div>
                                <div class="media-body media-middle">
                                    <?php if($r->online):?>
                                        <div class="action-btn">Ir al trámite en línea</div>
                                    <?php endif ?>
                                </div>
                            </div>
                        </li>
                        <hr>
                        <?php endforeach ?>
                    </ol>

                    <?=$results->appends(['category' => $category ? $category->id : null, 'institution' => $institution ? $institution->id : null])->links()?>
                <?php else: ?>
                    <div class="no-results">
                        <h4><i class="material-icons">youtube_searched_for</i> no hay resultados para los filtros utilizados</h4>
                        <p>Lo sentimos, no hay resultados disponibles bajo los filtros especificados, pruebe utilizando otro término o modificando los filtros de búsqueda en el menú lateral.</p>
                    </div>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>

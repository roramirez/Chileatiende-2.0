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
                                <?php if($r->online):?>
                                <div class="media-body media-middle">
                                    <a href="#" data-toggle="modal" data-target="#redirect-modal-<?= $r->id ?>" class="action-btn">Ir al trámite en línea</a>
                                </div>
                                <?php endif ?>
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
    <?php if($results->count()):?>
    <?php foreach($results as $r):?>
    <div class="modal modal-redirect fade" id="redirect-modal-<?= $r->$id ?>" class="" tabindex="-1" role="dialog" aria-labelledby="redirect-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"><i class="material-icons">error</i> Aviso de Redirección</h4>
                </div>
                <div class="modal-body">
                    Para realizar tu trámite te redirigiremos al sitio web institucional de <br />
                    <strong><? /* =$page->institution->name */ ?></strong>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Prefiero seguir en ChileAtiende</button>
                    <a class="btn btn-primary" href="<? /*=$page->online_url*/ ?>">Entendido, Ir al trámite</a>
                </div>
            </div>
        </div>
    </div>
    <?php endif ?>
</div>

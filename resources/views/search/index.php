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
                        <h4><a href="fichas/<?=$r->guid?>"><?=isset($r->highlight['title']) ? $r->highlight['title'][0] : $r->title?></a></h4>
                        <?php if($r->online):?><div class="online">Trámite Online</div><?php endif ?>
                        <p><?=str_limit(strip_tags(\App\Twig::strip(isset($r->highlight['objective']) ? $r->highlight['objective'][0] : $r->objective),'<em>'),500)?></p>
                    </li>
                    <?php endforeach ?>
                </ol>

                <?=$results->appends(['category' => $category ? $category->id : null, 'institution' => $institution ? $institution->id : null])->links()?>
            </div>
            <div class="col-sm-4">
                <div class="filter">
                    <h3><i class="material-icons">filter_list</i> Filtrar por</h3>

                    <form action="buscar">
                        <input type="hidden" name="query" value="<?=$query?>" />
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
        </div>
    </div>
</div>

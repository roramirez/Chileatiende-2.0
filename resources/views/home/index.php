<div id="home">
    <?php if(!empty($featured)):?>
    <div class="featured-area">
        <div class="container">
            <div class="title">
                <div class="heading-container">
                    <h2>Destacados</h2>
                </div>
                <a href="fichas/destacadas" class="featured-button hidden-xs">
                    Ver todos los destacados
                </a>
            </div>

            <div class="featured-list">
                <div class="featured-items">
                    <?php foreach ($featured as $f): ?>
                        <?php $f->publishedVersion() ?>
                            <div class="featured-item">
                                <a class="header" href="fichas/<?= $f->guid ?>" <?=$f->image ? 'style="background-image: url('.$f->image.')"':''?> data-ga-te-category="Tabs Fichas" data-ga-te-action="Ficha Destacadas" data-ga-te-value="<?=$f->id?>">
                                    <?php if (!$f->image): ?>
                                        <div class="image <?= (strlen($f->title) > 50 ? 'long-h' : 'short-h' );  ?>">
                                            <?= $f->title ?>
                                        </div>
                                    <?php endif ?>
                                </a>
                                <div class="caption">
                                    <h3><a href="fichas/<?= $f->guid ?>" data-ga-te-category="Tabs Fichas" data-ga-te-action="Ficha Destacadas" data-ga-te-value="<?=$f->id?>"><?= $f->title .' →' ?></a></h3>
                                </div>
                            </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>
    <?php endif ?>

    <div class="categories-area">
        <div class="container">
            <div class="title">
                <div class="subtitle">Trámites más visitados</div>
                <h2>Por categoría</h2>
            </div>

            <div class="row">
                <?php foreach($categories as $index=>$c):?>
                    <div class="col-md-4 col-sm-6">
                        <div class="category">
                            <a class="heading collapsed" role="button" data-toggle="collapse" href="#categoryCollapse-<?= $c->id ?>" aria-expanded="false" aria-controls="categoryCollapse">
                                <h3><?=$c->name?></h3>
                                <span class="caret"></span>
                            </a>
                            <div class="category-body collapse" id="categoryCollapse-<?= $c->id ?>">
                                <ul>
                                    <?php foreach(App\Page::popularPublishedVersions($c->id) as $p):?>
                                        <li>
                                            <a href="fichas/<?=$p->guid?>" title="<?= $p->title ?>" data-ga-te-category="Tabs Fichas" data-ga-te-action="Ficha Mas Visitadas" data-ga-te-value="<?=$p->master_id?>"><?=str_limit($p->title, 80)?></a>
                                            <?php if($p->online):?><div>Trámite en Línea</div><?php endif ?>
                                        </li>
                                    <?php endforeach ?>
                                </ul>
                                <a class="btn" href="buscar?category=<?=$c->id?>" data-ga-te-category="Menu Accesos" data-ga-te-action="clic" data-ga-te-value="<?=$c->id?>">Ir a <?=$c->name?></a>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>
</div>

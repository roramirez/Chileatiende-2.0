<div id="home">
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

            <div class="row">
                <?php foreach ($featured as $f): ?>
                    <?php $f->publishedVersion() ?>
                    <div class="col-sm-3">
                        <div class="featured">
                            <a class="header" href="fichas/<?= $f->guid ?>" <?=$f->image ? 'style="background-image: url('.$f->image.')"':''?>>
                                <?php if (!$f->image): ?>
                                    <div class="image <?= (strlen($f->title) > 50 ? 'long-h' : 'short-h' );  ?>">
                                        <?= $f->title ?>
                                    </div>
                                <?php endif ?>
                            </a>
                            <div class="caption">
                                <h3><a href="fichas/<?= $f->guid ?>"><?= $f->title .' →' ?></a></h3>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>

    <div class="categories-area">
        <div class="container">
            <div class="title">
                <div class="subtitle">Trámites más visitados</div>
                <h2>Por categoría</h2>
            </div>

            <div class="row">
                <?php foreach($categories as $c):?>
                    <div class="col-sm-4">
                        <div class="category">
                            <h3><?=$c->name?></h3>
                            <ul>
                                <?php foreach($c->pages()->masters()->published()->popular()->get() as $p):?>
                                    <?php $p = $p->publishedVersion() ?>
                                    <li>
                                        <a href="fichas/<?=$p->guid?>"><?=$p->title?></a>
                                        <?php if($p->online):?><div>Trámite en Línea</div><?php endif ?>
                                    </li>
                                <?php endforeach ?>
                            </ul>
                            <a class="btn" href="buscar?category=<?=$c->id?>">Ir a <?=$c->name?></a>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>
</div>

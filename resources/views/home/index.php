<div id="home">
    <div class="featured-area">
        <div class="container">
            <div class="title">
                <h2>Destacados</h2>
                <div class="subtitle">Actualizado al 05 de septiembre, 2017</div>
            </div>

            <div class="row">
                <?php foreach ($featured as $f): ?>
                    <div class="col-sm-3">
                        <div class="featured">
                            <a class="header" href="pages/<?= $f->id ?>">
                                <?php if ($f->image): ?>
                                    <img src="<?= $f->image ?>" class="img-responsive"/>
                                <?php else: ?>
                                    <div class="image">
                                        <?= $f->title ?>
                                    </div>
                                <?php endif ?>
                            </a>
                            <div class="caption">
                                <h3><a href="pages/<?= $f->id ?>"><?= $f->title ?></a></h3>
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
                <div class="subtitle">Trámites mas visitados</div>
                <h2>Por categoría</h2>
            </div>

            <div class="row">
                <?php foreach($categories as $c):?>
                    <div class="col-sm-4">
                        <div class="category">
                            <h3><?=$c->name?></h3>
                            <ul>
                                <?php foreach($c->pages()->popular() as $p):?>
                                    <li><a href="pages/<?=$p->id?>"><?=$p->title?></a></li>
                                <?php endforeach ?>
                            </ul>
                            <a class="btn" href="categories/<?=$c->id?>">Ir a <?=$c->name?></a>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>
</div>

<div id="featured-pages">
    <div class="container">
        <h2>Destacados</h2>
        <hr />

        <div class="row">
            <?php foreach ($pages as $f): ?>
                <?php $f->publishedVersion() ?>
                <div class="col-md-4 col-sm-6">
                    <div class="featured-item featured-page-item">
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
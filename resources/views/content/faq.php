<div id="privacy">
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="/"><i class="material-icons">home</i></a></li>
            <li><?= $title ?></li>
        </ol>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h1><?= $title ?></h1>
                <div class="updated-at">Actualizado al <?= $updated_at ?></div>
                <hr>
                <?= $content ?>
            </div>
        </div>
    </div>
</div>
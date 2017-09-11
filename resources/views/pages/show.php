<div id="page">
    <div class="container">

        <ol class="breadcrumb">
            <li><a href="">Inicio</a></li>
            <li><a href="categories/<?= $page->categories[0]->id ?>"><?= $page->categories[0]->name ?></a></li>
            <li><?= $page->title ?></li>
        </ol>

        <div class="row">
            <div class="col-sm-8">
                <h3><?= $page->title ?></h3>

                <?=$page->objective?>
            </div>
            <div class="col-sm-4">
                <ol>
                    <li><a>Descripción</a></li>
                    <li><a>¿A quién está dirigido?</a></li>
                    <li><a>¿Qué necesito para hacer el trámite?</a></li>
                    <li><a>¿Cómo y dónde hago el trámite? </a></li>
                </ol>
            </div>
        </div>
    </div>
</div>
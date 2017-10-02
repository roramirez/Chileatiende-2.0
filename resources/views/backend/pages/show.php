<div>
    <ol class="breadcrumb">
        <li><a href="backend">Inicio</a></li>
        <li><a href="backend/fichas">Fichas</a></li>
        <li><?=$page->title?></li>
        <li class="active">Ver</li>
    </ol>

    <ul class="nav nav-tabs">
        <li role="presentation" class="active"><a href="backend/fichas/<?=$page->id?>">Ver</a></li>
        <li role="presentation"><a href="backend/fichas/<?=$page->id?>/edit">Editar</a></li>
        <li role="presentation"><a href="backend/fichas/<?=$page->id?>/versions">Versiones</a></li>
    </ul>

    <br />

    <?php if(!$page->lastVersion()->published):?>
        <div class="alert alert-warning">
            Ficha no se encuentra publicada en su última versión.
            <a href="backend/fichas/<?=$page->id?>/versions/<?=$page->lastVersion()->id?>/publish">¿Desea publicar esta ficha en su última versión?</a></div>
    <?php endif ?>

    <div class="well">
        <page-master-form :page="<?=e($page)?>"></page-master-form>
    </div>

    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Campo</th>
            <th>Valor</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>Título</td>
            <td><?=$page->title?></td>
        </tr>
        <tr>
            <td>Descripción</td>
            <td><?=App\Twig::render($page->objective)?></td>
        </tr>
        </tbody>
    </table>
</div>
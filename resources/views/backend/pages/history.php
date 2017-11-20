<div>
    <ol class="breadcrumb">
        <li><a href="backend">Inicio</a></li>
        <li><a href="backend/fichas">Fichas</a></li>
        <?php if($edit):?><li><?=$page->title?></li><?php endif ?>
        <li class="active"><?=$edit?'Editar':'Crear'?></li>
    </ol>

    <ul class="nav nav-tabs">
        <li role="presentation"><a href="backend/fichas/<?=$page->id?>">Ver</a></li>
        <li role="presentation"><a href="backend/fichas/<?=$page->id?>/edit">Editar</a></li>
        <li role="presentation"><a href="backend/fichas/<?=$page->id?>/versions">Versiones</a></li>
        <li role="presentation" class="active"><a href="backend/fichas/<?=$page->id?>/history">Historial</a></li>
    </ul>

    <br />

    <table class="table table-striped">
        <tbody>
        <?php foreach($page->logs()->orderBy('id','desc')->get() as $l):?>
        <tr>
            <td style="width: 33%;">
                <h4>Fecha de Modificación:</h4>
                <p><?=$l->updated_at->formatLocalized('%c')?></p>
                <h4>Usuario:</h4>
                <p><?=$l->user ? $l->user->name : 'Usuario no existente'?></p>
            </td>
            <td>
                <h4>Ficha #<?=$l->page_id?> versión #<?=$l->page_version_id?></h4>
                <h5>Cambios Realizados:</h5>
                <div><?=\App\Twig::render($l->description)?></div>
            </td>
        </tr>
        <?php endforeach ?>
        </tbody>
    </table>


</div>
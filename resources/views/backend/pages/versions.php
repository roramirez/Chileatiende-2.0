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
        <li role="presentation" class="active"><a href="backend/fichas/<?=$page->id?>/versions">Versiones</a></li>
    </ul>

    <br />

    <table class="table">
        <thead>
        <tr>
            <th>Versión</th>
            <th>Publicada</th>
            <th>Fecha modificación</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($page->versions()->orderBy('id','desc')->get() as $v):?>
        <tr>
            <td><?=$v->id?></td>
            <td><?=$v->published ? 'Si':'No'?></td>
            <td><?=$v->updated_at?></td>
            <td class="text-center">
                <?php if(!$v->published):?>
                    <a href="backend/fichas/<?=$page->id?>/versions/<?=$v->id?>/publish" title="Publicar esta versión"><i class="material-icons">publish</i></a>
                <?php endif ?>
            </td>
        </tr>
        <?php endforeach ?>
        </tbody>
    </table>


</div>
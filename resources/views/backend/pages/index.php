<div>
    <ol class="breadcrumb">
        <li><a href="backend">Inicio</a></li>
        <li class="active">Fichas</li>
    </ol>

    <?php if(session()->has('status')):?>
    <div class="alert alert-success">
        <?=session('status')?>
    </div>
    <?php endif ?>

    <div>
        <a class="btn btn-success" href="backend/fichas/create">Agregar ficha</a>
    </div>

    <div class="text-center"><?=$pages->links()?></div>

    <table class="table">
        <thead>
        <tr>
            <th>Id</th>
            <th>Nombre del trámite</th>
            <th>Publicado</th>
            <th>Última modificación</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($pages as $p):?>
        <tr>
            <td><?=$p->id?></td>
            <td><a href="backend/fichas/<?=$p->id?>/edit"><?=$p->title?></a></td>
            <td class="text-center">
                <?php if($p->published):?>
                    <i class="material-icons" title="Publicado">check</i>
                    <?=$p->getLastVersion()->published ? '' : '<i class="material-icons">call_merge</i>'?>
                <?php else: ?>
                    <i class="material-icons" title="Publicado">cross</i>
                <?php endif ?>
            </td>
            <td><?=$p->updated_at?></td>
            <td class="text-center"><a href="backend/fichas/<?=$p->id?>/edit"><i class="material-icons">edit</i></a></td>
        </tr>
        <?php endforeach ?>
        </tbody>
    </table>

    <div class="text-center"><?=$pages->links()?></div>
</div>
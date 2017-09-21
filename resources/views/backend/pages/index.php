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
            <td class="text-center"><?=$p->published ? '<i class="material-icons">check</i>' : ''?></td>
            <td><?=$p->updated_at?></td>
            <td class="text-center"><a href="backend/fichas/<?=$p->id?>/edit"><i class="material-icons">edit</i></a></td>
        </tr>
        <?php endforeach ?>
        </tbody>
    </table>

    <div class="text-center"><?=$pages->links()?></div>
</div>
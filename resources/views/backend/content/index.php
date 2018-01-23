<div>
    <ol class="breadcrumb">
        <li><a href="backend">Inicio</a></li>
        <li class="active">Contenido</li>
    </ol>

    <?php if (Auth::user()->can('create', \App\Content::class)): ?>
        <div>
            <a class="btn btn-success" href="<?= route('contenidos.create') ?>">Agregar Contenido</a>
        </div>
    <?php endif ?>


    <table class="table">
        <thead>
        <tr>
            <th>Id</th>
            <th>Título</th>
            <th>Publicado</th>
            <th>Plantilla</th>
            <th>Url</th>
            <th>Última Modificación</th>
            <th width="15%">Acciones</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($content as $p): ?>
            <tr>
                <td><?= $p->id ?></td>
                <td><?= $p->title ?></td>
                <td class="text-center"><i class="material-icons"><?= $p->published ? 'check' : 'clear' ?></i></td>
                <td><?= $p->template ?></td>
                <td><?= $p->url ?></td>
                <td><?= $p->updated_at ?></td>
                <td class="text-center">
                    <a target="_blank" href="<?= $p->url ?>">
                        <i class="material-icons">open_in_browser</i>
                    </a>
                    <?php if (Auth::user()->can('update', $p)): ?>
                        <a href="backend/contenidos/<?= $p->id ?>/edit">
                            <i class="material-icons">edit</i>
                        </a>
                    <?php endif ?>
                    <?php if (Auth::user()->can('delete', $p)): ?>
                        <form id="form-<?= $p->id ?>" method="post" action="backend/contenidos/<?= $p->id ?>"
                              style="display: inline">
                            <?= csrf_field() ?>
                            <input type="hidden" name="_method" value="DELETE"/>
                            <a onclick="if(confirm('¿Está seguro que desea eliminar?')) document.querySelector('#form-<?= $p->id ?>').submit(); return false;"
                               href="#"><i class="material-icons">delete</i></a>
                        </form>
                    <?php endif ?>
                </td>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>

</div>
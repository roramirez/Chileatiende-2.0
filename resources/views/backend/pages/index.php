<div>
    <ol class="breadcrumb">
        <li><a href="backend">Inicio</a></li>
        <li class="active">Fichas</li>
    </ol>

    <div>
        <a class="btn btn-success" href="backend/fichas/create">Agregar ficha</a>
    </div>

    <div class="row">
        <div class="col-sm-offset-6 col-sm-6">
            <form>
                <div class="input-group">
                    <input type="text" class="form-control" name="query" value="<?=e($query)?>" placeholder="Ej: bono marzo">
                    <span class="input-group-btn">
                        <button class="btn btn-primary" type="submit">Buscar</button>
                    </span>
                </div>
            </form>
        </div>
    </div>

    <div class="text-center"><?=$pages->links()?></div>

    <table class="table">
        <thead>
        <tr>
            <th>Id</th>
            <th>Nombre del trámite</th>
            <th>Estado</th>
            <th>Publicado</th>
            <th>Última modificación</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($pages as $p):?>
        <tr>
            <td><?=$p->id?></td>
            <td>
                <?php if(Auth::user()->can('view',$p)): ?>
                    <a href="backend/fichas/<?=$p->id?>"><?=$p->title?></a>
                <?php else: ?>
                <?=$p->title?>
                <?php endif ?>
            </td>
            <td style="white-space: nowrap;">
                <?php if($p->status == 'rechazado'):?><i class="material-icons" style="font-size: 16px; cursor: pointer;" data-toggle="tooltip" title="<?=$p->status_comment?>">help</i><?php endif ?> <?=$p->status?>
            </td>
            <td class="text-center">
                <?php if($p->published):?>
                    <i class="material-icons" data-toggle="tooltip" title="Publicado">check</i>
                    <?=$p->lastVersion()->published ? '' : '<i class="material-icons" data-toggle="tooltip" title="No se encuentra publicada en su última versión">call_merge</i>'?>
                <?php endif ?>
            </td>
            <td><?=$p->updated_at?></td>
            <td class="text-center">
                <?php if(Auth::user()->can('update',$p)):?><a href="backend/fichas/<?=$p->id?>/edit"><i class="material-icons">edit</i></a><?php endif ?>
                <?php if(Auth::user()->can('delete',$p)):?>
                    <form id="delete-form-<?=$p->id?>" action="backend/fichas/<?=$p->id?>" method="post" style="display: inline">
                        <?=csrf_field()?>
                        <input type="hidden" name="_method" value="delete" />
                        <a href="#" onclick="event.preventDefault(); document.getElementById('delete-form-<?=$p->id?>').submit()"><i class="material-icons">delete</i></a>
                    </form>
                <?php endif ?>

            </td>
        </tr>
        <?php endforeach ?>
        </tbody>
    </table>

    <div class="text-center"><?=$pages->links()?></div>
</div>
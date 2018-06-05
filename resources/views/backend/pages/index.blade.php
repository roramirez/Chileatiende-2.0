<div>
    <ol class="breadcrumb">
        <li><a href="backend">Inicio</a></li>
        <li class="active">Fichas</li>
    </ol>

    <div>
        <a class="btn btn-success" href="backend/fichas/create">Agregar ficha</a>
    </div>

    <br />

    <div class="well">
        <page-filter-form :filters="<?=e(json_encode($filters))?>"></page-filter-form>
    </div>


    <div class="text-center"><?=$pages->appends($filters)->links()?></div>

    <div class="modal-limit">
        <table class="table">
            <thead>
            <tr>
                <th>@sortablelink('id','Id', ['page' => Request::get('page')])</th>
                <th>@sortablelink('title','Nombre del trámite', ['page' => Request::get('page')])</th>
                <th>@sortablelink('status','Estado', ['page' => Request::get('page')])</th>
                <th>@sortablelink('published','Publicado', ['page' => Request::get('page')])</th>
                <th>@sortablelink('updated_at','Última modificación', ['page' => Request::get('page')])</th>
                <th>Acciones</th>
                <th>Comunicación</th>
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
                    <?php if($p->status == 'rechazado'):?><i class="material-icons" style="font-size: 16px; cursor: pointer;" data-toggle="tooltip" title="<?=htmlspecialchars($p->status_comment)?>">help</i><?php endif ?> <?=$p->status ? __('chileatiende.'.$p->status) : ''?>
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
                            <a href="#" class="danger" v-confirm onclick="event.preventDefault(); document.getElementById('delete-form-<?=$p->id?>').submit()"><i class="material-icons">delete</i></a>
                        </form>
                    <?php endif ?>

                </td>
                <td class="text-center">
                    <a href="#" @click="showMessages($event, <?=$p->id?>)">
                        <i class="material-icons">message</i>
                    </a>
                </td>
            </tr>
            <?php endforeach ?>
            </tbody>
        </table>

        <Messages :owner="<?=Auth::user()->id?>"></Messages>
    </div>

    <div class="text-center"><?=$pages->appends($filters)->links()?></div>
</div>
<div>
    <ol class="breadcrumb">
        <li><a href="backend">Inicio</a></li>
        <li class="active">Oficinas</li>
    </ol>

    <div>
        <a class="btn btn-success" href="backend/oficinas/create">Agregar oficina</a>
    </div>


    <table class="table">
        <thead>
        <tr>
            <th>Nombre</th>
            <th>Comuna</th>
            <th>Dirección</th>
            <th>Latitud</th>
            <th>Longitud</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($offices as $p):?>
        <tr>
            <td><?=$p->name?></td>
            <td><?=$p->location->name?></td>
            <td><?=$p->address?></td>
            <td><?=$p->lat?></td>
            <td><?=$p->lng?></td>
            <td class="text-center">
                <a href="backend/oficinas/<?=$p->id?>/edit"><i class="material-icons">edit</i></a>
                <form id="form-<?=$p->id?>" method="post" action="backend/oficinas/<?=$p->id?>" style="display: inline">
                    <?=csrf_field()?>
                    <input type="hidden" name="_method" value="DELETE" />
                    <a onclick="if(confirm('¿Está seguro que desea eliminar?')) document.querySelector('#form-<?=$p->id?>').submit(); return false;" href="#"><i class="material-icons">delete</i></a>
                </form>
            </td>
        </tr>
        <?php endforeach ?>
        </tbody>
    </table>

</div>
<div>
    <ol class="breadcrumb">
        <li><a href="backend">Inicio</a></li>
        <li class="active">Usuarios</li>
    </ol>

    <div>
        <a class="btn btn-success" href="backend/usuarios/create">Agregar usuario</a>
    </div>


    <table class="table">
        <thead>
        <tr>
            <th>Nombre</th>
            <th>E-Mail</th>
            <th>Institución</th>
            <th>Rol</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($users as $p):?>
        <tr>
            <td><?=$p->name?></td>
            <td><?=$p->email?></td>
            <td><?=$p->institution ? $p->institution->name : 'No tiene'?></td>
            <td><?=$p->role?></td>
            <td class="text-center">
                <a href="backend/usuarios/<?=$p->id?>/edit"><i class="material-icons">edit</i></a>
                <form id="form-<?=$p->id?>" method="post" action="backend/usuarios/<?=$p->id?>" style="display: inline">
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
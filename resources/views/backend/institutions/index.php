<div>
    <ol class="breadcrumb">
        <li><a href="backend">Inicio</a></li>
        <li class="active">Instituciones</li>
    </ol>

    <div>
        <a class="btn btn-success" href="backend/instituciones/create">Agregar institución</a>
    </div>


    <table class="table">
        <thead>
        <tr>
            <th>Nombre</th>
            <th>Ministerio</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($institutions as $p):?>
        <tr>
            <td><?=$p->name?></td>
            <td><?=$p->ministry->name?></td>
            <td class="text-center">
                <a href="backend/instituciones/<?=$p->id?>/edit"><i class="material-icons">edit</i></a>
                <form id="form-<?=$p->id?>" method="post" action="backend/instituciones/<?=$p->id?>" style="display: inline">
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
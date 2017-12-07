<div>
    <ol class="breadcrumb">
        <li><a href="backend">Inicio</a></li>
        <li class="active">Oficinas</li>
    </ol>

    <div>
        <a class="btn btn-success" href="backend/categorias/create">Agregar categoría</a>
    </div>


    <table class="table">
        <thead>
        <tr>
            <th>Nombre</th>
            <th>Destacada</th>
            <th>Chilenos en Exterior</th>
            <th>Orden</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($categories as $p):?>
        <tr>
            <td><?=$p->name?></td>
            <td><i class="material-icons"><?=$p->featured ? 'check' : ''?></i></td>
            <td><i class="material-icons"><?=$p->exterior ? 'check' : ''?></i></td>
            <td><?=$p->order?></td>
            <td class="text-center">
                <a href="backend/categorias/<?=$p->id?>/edit"><i class="material-icons">edit</i></a>
                <form id="form-<?=$p->id?>" method="post" action="backend/categorias/<?=$p->id?>" style="display: inline">
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
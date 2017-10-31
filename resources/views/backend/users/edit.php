<div>
    <ol class="breadcrumb">
        <li><a href="backend">Inicio</a></li>
        <li><a href="backend/usuarios">Usuarios</a></li>
        <?php if($edit):?><li><?=$user->name?></li><?php endif ?>
        <li class="active"><?=$edit?'Editar':'Crear'?></li>
    </ol>


    <user-form :user='<?=e($user)?>' :edit="<?=$edit ? 'true' : 'false'?>"></user-form>

</div>
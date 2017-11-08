<div>
    <ol class="breadcrumb">
        <li><a href="backend">Inicio</a></li>
        <li><a href="backend/instituciones">Instituciones</a></li>
        <?php if($edit):?><li><?=$institution->name?></li><?php endif ?>
        <li class="active"><?=$edit?'Editar':'Crear'?></li>
    </ol>


    <institution-form :institution='<?=e($institution)?>' :edit="<?=$edit ? 'true' : 'false'?>"></institution-form>

</div>
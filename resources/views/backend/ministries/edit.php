<div>
    <ol class="breadcrumb">
        <li><a href="backend">Inicio</a></li>
        <li><a href="backend/instituciones">Ministerios</a></li>
        <?php if($edit):?><li><?=$ministry->name?></li><?php endif ?>
        <li class="active"><?=$edit?'Editar':'Crear'?></li>
    </ol>


    <ministry-form :ministry='<?=e($ministry)?>' :edit="<?=$edit ? 'true' : 'false'?>"></ministry-form>

</div>
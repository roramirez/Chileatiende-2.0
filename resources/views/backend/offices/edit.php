<div>
    <ol class="breadcrumb">
        <li><a href="backend">Inicio</a></li>
        <li><a href="backend/oficinas">Oficinas</a></li>
        <?php if($edit):?><li><?=$office->name?></li><?php endif ?>
        <li class="active"><?=$edit?'Editar':'Crear'?></li>
    </ol>


    <office-form :office='<?=e($office->toJson(JSON_FORCE_OBJECT))?>' :edit="<?=$edit ? 'true' : 'false'?>"></office-form>

</div>
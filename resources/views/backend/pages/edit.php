<div>
    <ol class="breadcrumb">
        <li><a href="backend">Inicio</a></li>
        <li><a href="backend/fichas">Fichas</a></li>
        <?php if($edit):?><li><?=$page->title?></li><?php endif ?>
        <li class="active"><?=$edit?'Editar':'Crear'?></li>
    </ol>

    <page-form :page="<?=e($page)?>" :edit="<?=$edit ? 'true' : 'false'?>"></page-form>

</div>
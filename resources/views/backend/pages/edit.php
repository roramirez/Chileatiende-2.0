<div>
    <ol class="breadcrumb">
        <li><a href="backend">Inicio</a></li>
        <li><a href="backend/fichas">Fichas</a></li>
        <?php if($edit):?><li><?=$page->title?></li><?php endif ?>
        <li class="active"><?=$edit?'Editar':'Crear'?></li>
    </ol>

    <ul class="nav nav-tabs">
        <li role="presentation" class="active"><a href="backend/fichas/<?=$page->id?>/edit">Editar</a></li>
        <li role="presentation"><a href="backend/fichas/<?=$page->id?>/versions">Versiones</a></li>
    </ul>

    <br />

    <page-form :page="<?=e($page)?>" :edit="<?=$edit ? 'true' : 'false'?>"></page-form>

</div>
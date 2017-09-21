<div>
    <ol class="breadcrumb">
        <li><a href="backend">Inicio</a></li>
        <li><a href="backend/<?=$page->id?>/edit"><?=$page->title?></a></li>
        <li class="active">Editar</li>
    </ol>

    <page-form :page="<?=e($page)?>"></page-form>

</div>
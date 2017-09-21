<div>
    <ol class="breadcrumb">
        <li><a href="backend">Inicio</a></li>
        <li><a href="backend/fichas">Fichas</a></li>
        <li><?=$page->title?></li>
        <li class="active">Editar</li>
    </ol>

    <page-form :page="<?=e($page)?>"></page-form>

</div>
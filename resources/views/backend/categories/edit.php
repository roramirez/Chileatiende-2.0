<div>
    <ol class="breadcrumb">
        <li><a href="backend">Inicio</a></li>
        <li><a href="backend/categorias">Categorías</a></li>
        <?php if($edit):?><li><?=$category->name?></li><?php endif ?>
        <li class="active"><?=$edit?'Editar':'Crear'?></li>
    </ol>


    <category-form :category='<?=e($category->toJson(JSON_FORCE_OBJECT))?>' :edit="<?=$edit ? 'true' : 'false'?>"></category-form>

</div>
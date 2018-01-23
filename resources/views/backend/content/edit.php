<div>
    <ol class="breadcrumb">
        <li><a href="backend">Inicio</a></li>
        <li><a href="backend/contenidos">Contenido</a></li>
        <?php if ($edit): ?>
            <li><?= $content->title ?></li>
        <?php endif ?>
        <li class="active"><?= $edit ? 'Editar' : 'Crear' ?></li>
    </ol>


    <content-form :templates='<?= e($templates->toJson(JSON_FORCE_OBJECT)) ?>'
                  :content='<?= e($content->toJson(JSON_FORCE_OBJECT)) ?>'
                  :edit="<?= $edit ? 'true' : 'false' ?>"></content-form>

</div>
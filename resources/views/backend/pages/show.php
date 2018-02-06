<div>
    <ol class="breadcrumb">
        <li><a href="backend">Inicio</a></li>
        <li><a href="backend/fichas">Fichas</a></li>
        <li><?=$page->title?></li>
        <li class="active">Ver</li>
    </ol>

    <ul class="nav nav-tabs">
        <li role="presentation" class="active"><a href="backend/fichas/<?=$page->id?>">Ver</a></li>
        <li role="presentation"><a href="backend/fichas/<?=$page->id?>/edit">Editar</a></li>
        <li role="presentation"><a href="backend/fichas/<?=$page->id?>/versions">Versiones</a></li>
        <li role="presentation"><a href="backend/fichas/<?=$page->id?>/history">Historial</a></li>
    </ul>

    <br />

    <?php if($page->published):?>
    <div class="alert alert-success">
        <p><strong>Ficha Publicada</strong></p>
    </div>
    <?php else: ?>
    <div class="alert alert-warning">
        <p><strong>Ficha Despublicada</strong></p>
        <?php if($page->status_comment):?>
            <p><?=$page->status_comment?></p>
        <?php endif ?>
    </div>
    <?php endif ?>

    <?php if (Auth::user()->can('updateMaster',$page)):?>
    <?php if($page->published && !$page->lastVersion()->published):?>
        <div class="alert alert-warning">
            <p><strong>Ficha no se encuentra publicada en su última versión:</strong></p>
            <p><a href="backend/fichas/<?=$page->id?>/versions/<?=$page->lastVersion()->id?>/publish">¿Desea publicar esta ficha en su última versión?</a></p>
        </div>
    <?php endif ?>
    <?php endif ?>

    <?php if($page->status == 'rechazado'):?>
        <div class="alert alert-warning">
            <p><strong>Esta ficha se encuentra con las siguientes observaciones:</strong></p>
            <p><?=$page->status_comment?></p>
        </div>
    <?php endif ?>

    <?php if (Auth::user()->can('updateMaster',$page)):?>
    <div class="well">
        <page-master-form :page="<?=e($page)?>"></page-master-form>
    </div>
    <?php endif ?>

    <page-status-form :page="<?=e($page)?>"></page-status-form>

    <br />


    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Campo</th>
            <th>Valor</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>Título</td>
            <td><?=$page->title?></td>
        </tr>
        <tr>
            <td>Descripción</td>
            <td><?=App\Twig::render($page->objective)?></td>
        </tr>
        <tr>
            <td>Detalles</td>
            <td><?=App\Twig::render($page->details)?></td>
        </tr>
        <tr>
            <td>Beneficiarios</td>
            <td><?=App\Twig::render($page->beneficiaries)?></td>
        </tr>
        <tr>
            <td>Requerimientos</td>
            <td><?=App\Twig::render($page->requirements)?></td>
        </tr>
        <tr>
            <td>Costo</td>
            <td><?=App\Twig::render($page->cost)?></td>
        </tr>
        <tr>
            <td>Vigencia</td>
            <td><?=App\Twig::render($page->validity)?></td>
        </tr>
        <tr>
            <td>Marco Legal</td>
            <td><?=App\Twig::render($page->legal)?></td>
        </tr>
        <tr>
            <td>Guía Online</td>
            <td>
                <?=App\Twig::render($page->online_guide)?>
                <?php if($page->online_url):?><p><a href="<?=$page->online_url?>" target="_blank"><?=$page->online_url?></a></p><?php endif ?>
            </td>
        </tr>
        <tr>
            <td>Guía Oficina</td>
            <td><?=App\Twig::render($page->office_guide)?></td>
        </tr>
        <tr>
            <td>Guía Correo</td>
            <td><?=App\Twig::render($page->mail_guide)?></td>
        </tr>
        <tr>
            <td>Guía Telefónico</td>
            <td><?=App\Twig::render($page->phone_guide)?></td>
        </tr>
        <tr>
            <td>Guía Consulado</td>
            <td><?=App\Twig::render($page->consulate_guide)?></td>
        </tr>
        <tr>
            <td>Keywords</td>
            <td><?=App\Twig::render($page->keywords)?></td>
        </tr>
        </tbody>
    </table>
</div>
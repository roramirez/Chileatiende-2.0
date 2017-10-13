<div id="institutions">
    <div class="container">

        <ol class="breadcrumb">
            <li><a href=""><i class="material-icons">home</i></a></li>
            <li>Instituciones Asociadas</li>
        </ol>

        <h3>Listado de Instituciones Asociadas</h3>
        <div>Actualizado al <?=Carbon\Carbon::now()->formatLocalized('%d de %B, %Y')?></div>

        <hr />

        <ul class="index">
            <?php foreach($institutions as $letter => $i):?>
            <li><a href="<?=Request::url()?>#<?=$letter?>"><?=$letter?></a></li>
            <?php endforeach ?>
        </ul>

        <br />

        <ul class="directory">
            <?php foreach($institutions as $letter => $i):?>
            <li id="<?=$letter?>">
                <div class="letter"><?=$letter?></div>
                <ul>
                    <?php foreach($i as $i2):?>
                    <li><a href="buscar?institution=<?=$i2->id?>"><?=$i2->name?></a></li>
                    <?php endforeach ?>
                </ul>
            </li>
            <?php endforeach ?>
        </ul>
    </div>
</div>

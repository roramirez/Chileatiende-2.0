<div id="institutions">
    <div class="container">

        <ol class="breadcrumb">
            <li><a href=""><i class="material-icons">home</i></a></li>
            <li class="active">Instituciones que publican en el Portal</li>
        </ol>

        <h3>Instituciones que publican en el Portal</h3>
        <div>Actualizado al <?=Carbon\Carbon::now()->formatLocalized('%d de %B, %Y')?></div>

        <hr />
        <div class="row ">
            <div class="col-md-12">
                <div class="index-container" data-gumshoe-header data-spy="affix" data-offset-top="250" data-offset-bottom="500">
                    <ul class="index" data-gumshoe>
                        <?php foreach($institutions as $letter => $i):?>
                        <li><a href="<?=Request::url()?>#<?=$letter?>"><?=$letter?></a></li>
                        <?php endforeach ?>
                    </ul>
                </div>  
            </div>
        </div>
        <ul class="directory">
            <?php foreach($institutions as $letter => $i):?>
            <li id="<?=$letter?>">
                <div class="letter"><?=$letter?></div>
                <ul>
                    <?php foreach($i as $i2):?>
                    <li><a href="instituciones/<?=$i2->id?>"><?=$i2->name?></a></li>
                    <?php endforeach ?>
                </ul>
            </li>
            <?php endforeach ?>
        </ul>
    </div>
</div>

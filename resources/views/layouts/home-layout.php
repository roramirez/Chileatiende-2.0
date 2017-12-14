<?=view('chunks/head', ['title' => $title])?>
<div id="app">
    <header class="home"
            <?php if($skin == 'ugly'):?>style="background-image: none;"<?php endif ?>
            <?php if($skin == 'gob'):?>style="background-image: url(images/home-gob.jpg);"<?php endif ?>
            <?php if($skin == 'mujer'):?>style="background-image: url(images/home-mujer.jpg);"<?php endif ?>
            <?php if($skin == 'exterior'):?>style="background-image: url(images/home-exterior.jpg);"<?php endif ?>
    >
        <?= view('chunks/navbar', ['skin'=>$skin]) ?>

        <div class="main">
            <div class="container">

                <h2>
                    ¡Hola! Estás en ChileAtiende
                    <?php if($skin == 'exterior'):?>
                        <span class="exterior">/ Exterior</span>
                    <?php elseif ($skin == 'mujer'): ?>
                        <span class="mujer">/ Mujer</span>
                    <?php endif ?>
                </h2>
                <h3>Guía de Trámites y Servicios del Estado</h3>


                <label>¿Qué trámite o servicio buscas?</label>
                <form action="buscar">
                    <search id="search" class="search" name="query" value=""></search>
                </form>
                <div class="search-list-container">
                    <h4>Lo más buscado</h4>
                    <div class="search-list-items">
                        <ul class="search-list searchtags-mask">
                            <?php foreach($suggestions as $s):?>
                                <li><a href="buscar?query=<?=htmlspecialchars($s->query)?>"><?=htmlspecialchars($s->query)?></a></li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main>
        <?=$content?>
    </main>
    <?=view('chunks/banner')?>
    <div class="modal fade claveunica-modal" id="claveunica-modal" class="" tabindex="-1" role="dialog" aria-labelledby="claveunica-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <!-- <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Sección en desarrollo</h4>
                </div> -->
                <div class="modal-body">
                    <h4>Sección en Desarrollo</h4>
                    <p>Portal Chileatiende en etapa Beta</p>
                </div>
                <div class="text-right">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Volver</button>
                </div>
            </div>
        </div>
    </div>
    <?=view('chunks/footer', ['skin'=>$skin])?>
</div>
<?=view('chunks/foot')?>
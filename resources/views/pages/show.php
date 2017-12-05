<div id="page">
    <div class="container">
        <ol class="breadcrumb">
            <li><a href=""><i class="material-icons">home</i></a></li>
            <li><a href="instituciones/<?= $page->institution->id ?>"><?= $page->institution->name ?></a></li>
            <li><?= $page->title ?></li>
        </ol>
        <div class="row">
            <div class="col-md-4 col-md-push-8">
                <page-nav :page="<?= e(json_encode($page)) ?>" current-url="<?= url()->current() ?>"></page-nav>
            </div>
            <div class="col-md-8 col-md-pull-4" id="page-content">
                <div class="rs_preserve">
                    <?php if($page->online):?><div class="online">Trámite en Línea</div><?php endif ?>
                    <h2><?= $page->title ?></h2>
                    <div class="author"><a href="instituciones/<?=$page->institution->id?>">Información proporcionada por <?= $page->institution->name ?></a></div>
                    <?php if($page->published_at):?><div class="updated-at">Actualizado al <?=$page->published_at->formatLocalized('%d de %B, %Y')?></div><?php endif ?>
                    <div class="accessibility-bar rs_skip hidden-print">
                        <div id="readspeaker_button1" ref="readspeakerButton" class="rs_skip rsbtn rs_preserve" v-show="page.showReadspeakerButton">
                            <a rel="nofollow" class="rsbtn_play" accesskey="L" title="Escucha esta p&aacute;gina utilizando ReadSpeaker" href="//app-na.readspeaker.com/cgi-bin/rsent?customerid=6404&lang=es_us&readid=page-content&url=<?= rawurlencode(url()->current()) ?>">
                                <span class="rsbtn_left rsimg rspart"><span class="rsbtn_text"><span>Escuchar</span></span></span>
                                <span class="rsbtn_right rsimg rsplay rspart"></span>
                            </a>
                        </div>
                        <div class="resize-font">
                            <span class="larger" @click.prevent="resizePageFontSize(true)">
                                A+
                            </span>
                            <span class="smaller" @click.prevent="resizePageFontSize(false)">
                                A-
                            </span>
                        </div>
                        <a href="#" @click.prevent="toggleReadspeaker" class="listen-page">
                            <i class="material-icons">hearing</i>
                            escuchar
                        </a>
                        <span class="print-page" onClick="window.print()">
                            <i class="material-icons">print</i>
                            imprimir
                        </span>
                        <div class="share-buttons">
                            <span>Compartir</span>
                            <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?=url('')?>" class="share-icon" title="Compartir en Facebook">
                                <svg width="18px" height="18px" viewBox="0 0 18 18" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <g id="fb-icon" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <g id="Ficha-trámite/-extenso" class="social-icon" transform="translate(-821.000000, -440.000000)" fill="#D7D6D7">
                                            <path d="M834.928588,440.285696 L824.21429,440.285696 C822.439734,440.285696 821,441.725429 821,443.499985 L821,454.214284 C821,455.988839 822.439734,457.428573 824.21429,457.428573 L830.151797,457.428573 L830.151797,450.78794 L827.919651,450.78794 L827.919651,448.198651 L830.151797,448.198651 L830.151797,446.290167 C830.151797,444.080343 831.513405,442.874984 833.488854,442.874984 C834.426355,442.874984 835.241088,442.941949 835.475464,442.975431 L835.475464,445.285702 L834.113855,445.296862 C833.031264,445.296862 832.830371,445.799095 832.830371,446.546864 L832.830371,448.198651 L835.386178,448.198651 L835.051356,450.78794 L832.830371,450.78794 L832.830371,457.428573 L834.928588,457.428573 C836.703144,457.428573 838.142878,455.988839 838.142878,454.214284 L838.142878,443.499985 C838.142878,441.725429 836.703144,440.285696 834.928588,440.285696 Z" id="facebook-square---FontAwesome"></path>
                                        </g>
                                    </g>
                                </svg>
                            </a>
                            <a target="_blank" href="https://twitter.com/intent/tweet?text=<?= $page->title ?>&url=<?= url('').'/'.$page->guid ?>" class="share-icon" title="compartir en Twitter">
                                <svg width="18px" height="18px" viewBox="0 0 18 18" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <g id="twitter-icon" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <g id="Ficha-trámite/-extenso" class="social-icon" transform="translate(-853.000000, -440.000000)" fill="#D7D6D7">
                                            <path d="M867.285731,445.665166 C866.861624,445.854899 866.415195,445.977667 865.935283,446.044631 C866.426355,445.754452 866.794659,445.285702 866.973231,444.738826 C866.515641,445.006683 866.013408,445.207576 865.477693,445.308023 C865.053586,444.850433 864.439746,444.571415 863.770102,444.571415 C862.475458,444.571415 861.426349,445.620523 861.426349,446.915168 C861.426349,447.093739 861.43751,447.283472 861.482153,447.450883 C859.529026,447.350436 857.799113,446.424096 856.638397,444.995523 C856.437504,445.341505 856.314736,445.754452 856.314736,446.17856 C856.314736,446.993293 856.694201,447.707579 857.330362,448.131687 C856.939737,448.120526 856.571433,448.008919 856.21429,447.841508 L856.21429,447.86383 C856.21429,449.002224 857.073666,449.950886 858.145095,450.162939 C857.944202,450.218743 857.787952,450.252225 857.575898,450.252225 C857.430809,450.252225 857.285719,450.229904 857.14063,450.207582 C857.44197,451.133923 858.301346,451.814727 859.328133,451.837049 C858.52456,452.462049 857.520095,452.841514 856.415183,452.841514 C856.22545,452.841514 856.035718,452.830353 855.857146,452.808032 C856.895094,453.466515 858.122774,453.85714 859.450901,453.85714 C863.758941,453.85714 866.125016,450.285707 866.125016,447.183025 C866.125016,447.082579 866.125016,446.982132 866.113855,446.881686 C866.571445,446.558024 866.973231,446.145078 867.285731,445.665166 Z M870.142878,443.499985 L870.142878,454.214284 C870.142878,455.988839 868.703144,457.428573 866.928588,457.428573 L856.21429,457.428573 C854.439734,457.428573 853,455.988839 853,454.214284 L853,443.499985 C853,441.725429 854.439734,440.285696 856.21429,440.285696 L866.928588,440.285696 C868.703144,440.285696 870.142878,441.725429 870.142878,443.499985 Z" id="twitter-square---FontAwesome"></path>
                                        </g>
                                    </g>
                                </svg>
                            </a>
                            <a href="mailto:?subject=<?=$page->title ?>&amp;body=<?= url('').'/'.$page->guid ?>" class="share-icon" title="compartir por email">
                                <svg width="20px" height="17px" viewBox="0 0 20 17" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <g id="email-icon" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <g id="Ficha-trámite/-extenso" class="social-icon" transform="translate(-885.000000, -441.000000)" fill="#D7D6D7">
                                            <path d="M905.000024,446.781239 L905.000024,455.642857 C905.000024,456.625001 904.196451,457.428573 903.214307,457.428573 L886.785716,457.428573 C885.803572,457.428573 885,456.625001 885,455.642857 L885,446.781239 C885.334822,447.149543 885.714287,447.473204 886.127233,447.752222 C887.979914,449.013385 889.854917,450.274547 891.674115,451.602673 C892.611616,452.294638 893.772332,453.142854 894.988851,453.142854 L895.011173,453.142854 C896.227692,453.142854 897.388408,452.294638 898.325909,451.602673 C900.145107,450.285707 902.02011,449.013385 903.883951,447.752222 C904.285737,447.473204 904.665202,447.149543 905.000024,446.781239 Z M905.000024,443.499985 C905.000024,444.749987 904.073683,445.87722 903.091539,446.558024 C901.350466,447.763383 899.598232,448.968742 897.868319,450.185261 C897.142872,450.687494 895.915192,451.714281 895.011173,451.714281 L894.988851,451.714281 C894.084832,451.714281 892.857152,450.687494 892.131705,450.185261 C890.401792,448.968742 888.649558,447.763383 886.919645,446.558024 C886.127233,446.02231 885,444.761147 885,443.745521 C885,442.65177 885.591519,441.714269 886.785716,441.714269 L903.214307,441.714269 C904.185291,441.714269 905.000024,442.517841 905.000024,443.499985 Z" id="envelope---FontAwesome"></path>
                                        </g>
                                    </g>
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div class="page-content">
                        <h4 id="objective">Descripción</h4>
                        <?=App\Twig::render($page->objective)?>

                        <?php if($page->legal):?>
                            <br />
                            <expandable class="important" :max-length="100" title="Marco Legal" content="<?=e($page->legal)?>"></expandable>
                        <?php endif ?>

                        <?php if($page->details):?>
                        <h4 id="details">Detalles</h4>
                        <?=App\Twig::render($page->details)?>
                        <?php endif ?>

                        <h4 id="beneficiaries">¿A quién está dirigido?</h4>
                        <?=App\Twig::render($page->beneficiaries)?>

                        <?php if($page->requirements):?>
                        <h4 id="requirements">¿Qué necesito para hacer el trámite?</h4>
                        <?=App\Twig::render($page->requirements)?>
                        <?php endif ?>

                        <?php if($page->howto):?>
                        <h4 id="howto">¿Cómo y dónde hago el trámite?</h4>
                        <div class="howto main-tabs">
                            <ul class="nav nav-tabs" role="tablist" v-select-first-tab>
                                <?php if($page->online):?><li role="presentation"><a href="#online" aria-controls="online" role="tab" data-toggle="tab"><i class="material-icons">devices</i>En línea</a></li><?php endif ?>
                                <?php if($page->office):?><li role="presentation"><a href="#office" aria-controls="office" role="tab" data-toggle="tab"><i class="material-icons">store</i>En oficina</a></li><?php endif ?>
                                <?php if($page->phone):?><li role="presentation"><a href="#phone" aria-controls="phone" role="tab" data-toggle="tab"><i class="material-icons">phone</i>Telefónico</a></li><?php endif ?>
                                <?php if($page->mail):?><li role="presentation"><a href="#mail" aria-controls="mail" role="tab" data-toggle="tab"><i class="material-icons">mail</i>Correo</a></li><?php endif ?>
                            </ul>

                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane" id="online">
                                    <div class="visible-print-block"><strong>- Instrucciones Trámite en Línea</strong></div>
                                    <?=App\Twig::render($page->online_guide)?>
                                    <a class="btn btn-online hidden-print" href="<?= $page->online_url ?>" data-toggle="modal" data-target="#redirect-modal">Ir al trámite en línea</a>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="office">
                                    <div class="visible-print-block"><strong>- Instrucciones Trámite en Sucursal</strong></div>
                                    <?=App\Twig::render($page->office_guide)?>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="phone">
                                    <div class="visible-print-block"><strong>- Instrucciones contacto telefónico</strong></div>
                                    <?=App\Twig::render($page->phone_guide)?>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="mail">
                                    <div class="visible-print-block"><strong>- Instrucciones trámite por Email</strong></div>
                                    <?=App\Twig::render($page->mail_guide)?>
                                </div>
                            </div>
                        </div>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="similar-pages" class="similar-pages hidden-print">
        <div class="container">
            <div class="title">
                <h3><i class="material-icons">visibility</i> Los usuarios también visitaron</h3>
            </div>
            <div class="row">
                <?php foreach($page->masterPage->similarPages as $s):?>
                    <div class="col-sm-4">
                        <div class="similar-page-container">
                            <div class="institution"><a href="buscar?institution=<?=$s->institution->id?>">Publicado por <?=$s->institution->name?></a></div>
                            <h4><a href="fichas/<?=$s->guid?>"><?=$s->title?></a></h4>
                            <?php if($s->online):?><div class="online">Trámite en Línea</div><?php endif ?>
                            <p><?=str_limit(strip_tags(\App\Twig::strip($s->objective)),100)?></p>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>
    <div id="need-help">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <h3>¿Necesitas Ayuda?</h3>
                    <h4>Llámanos al 101</h4>
                    <p>Lunes a Jueves, de 8:00 a 20:00 hrs.</p>
                    <p>Viernes, de 8:00 a 18:00 hrs.</p>
                </div>
                <div class="col-md-6">
                    <p>Para hacer tu atención más expedita, indícanos este Código de Trámite</p>
                    <div class="page-id-container">
                        <div class="heading">código de trámite</div>
                        <div class="number"><?= $page->master_id ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal modal-redirect fade" id="redirect-modal" class="" tabindex="-1" role="dialog" aria-labelledby="redirect-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"><i class="material-icons">error</i> Aviso de Redirección</h4>
                </div>
                <div class="modal-body">
                    Para realizar tu trámite te redirigiremos al sitio web institucional de <br />
                    <strong><?=$page->institution->name?></strong>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Prefiero seguir en ChileAtiende</button>
                    <a class="btn btn-primary" href="<?=$page->online_url?>">Entendido, Ir al trámite</a>
                </div>
            </div>
        </div>
    </div>
</div>

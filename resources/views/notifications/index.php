<div id="notifications">
    <div class="container">
        <h4>Bienvenido(a) a Mi ChileAtiende</h4>
        <h3>Centro de Notificaciones (<?=$notifications->total()?>)</h3>

        <hr />

        <div class="row">
            <div class="col-sm-3">
                <div class="list-group">
                    <a href="notificaciones" class="list-group-item <?=$read == null ? 'active':''?>">Todos <span class="badge"><i class="material-icons">keyboard_arrow_right</i></span></a>
                    <a href="notificaciones?read=1" class="list-group-item <?=$read === '1' ? 'active':''?>">Leidos <span class="badge"><i class="material-icons">keyboard_arrow_right</i></span></a>
                    <a href="notificaciones?read=0" class="list-group-item <?=$read === '0' ? 'active':''?>">No leidos (<?=$unreadCount?>)<span class="badge"><i class="material-icons">keyboard_arrow_right</i></span></a>
                </div>
            </div>
            <div class="col-sm-9">
                <?php if($notifications->count()):?>
                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    <?php foreach($notifications as $n):?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-sm-6">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse-<?=$n->id?>" aria-expanded="true" aria-controls="collapseOne">
                                       <?=$n->title?>
                                    </a>
                                </div>
                                <div class="col-sm-6">
                                    <div class="text-right">
                                        <?=$n->created_at->formatLocalized('%D')?>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div id="collapse-<?=$n->id?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                            <div class="panel-body">
                                <div class="sender">Mensaje enviado por <?=$n->institution->name?></div>
                                <h5><?=$n->title?></h5>
                                <hr />
                                <?=$n->message?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach ?>
                </div>
                <div class="text-center"><?=$notifications->appends(['read' => $read])->links()?></div>
                <?php else: ?>
                <p class="text-center">No tiene notificaciones</p>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>
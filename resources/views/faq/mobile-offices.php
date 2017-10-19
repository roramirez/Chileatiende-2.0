<div id="oficinas-moviles">
	<div class="container">
		<ol class="breadcrumb">
            <li><a href=""><i class="material-icons">home</i></a></li>
            <li><a href="/ayuda/">Centro de Ayuda</a></li>
            <li>Oficinas Móviles</li>
        </ol>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="help-heading">
					<div class="subheading">
						Bienvenido al centro de ayuda
					</div>
					<h2>¿En qué te podemos ayudar?</h2>
				</div>
			</div>
		</div>
		<?=view('chunks/help/help-cards')?>
		<div class="row">
			<div class="col-md-9">
				<h2>Oficinas Móviles</h2>
				<p>Seis oficinas móviles distribuidas en las regiones de O'Higgins, Bío Bío, La Araucanía, Metropolitana, Valparaíso y Coquimbo donde encontrarás información y orientación para postulaciones, reclamos y obtención de certificados, entre otros trámites del Estado.</p>
				<div class="main-tabs">
	                <ul class="nav nav-tabs" role="tablist" v-select-first-tab>
                        <?php foreach($offices->groupBy('location.parent.parent.id') as $location => $off):?>
                            <li role="presentation"><a href="#location-<?=$location?>" aria-controls="online" role="tab" data-toggle="tab"><?=$off[0]->location->parent->parent->name?></a></li>
                        <?php endforeach ?>
	                </ul>
	                <div class="tab-content">
                        <?php foreach($offices->groupBy('location.parent.parent.id') as $location => $off):?>
	                    <div role="tabpanel" class="tab-pane" id="location-<?=$location?>">
	                    	<table class="table">
                                <thead>
                                <tr>
                                    <th>Ubicación</th>
                                    <th>Horario</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($off as $o):?>
                                <tr>
                                    <td>
                                        <div class="city"><?=$o->location->name?></div>
                                        <?=$o->address?>
                                    </td>
                                    <td><?=$o->schedules?></td>
                                </tr>
                                <?php endforeach ?>
                                </tbody>
                            </table>
	                    </div>
                        <?php endforeach ?>
	                </div>
               	</div>
			</div>
			<div class="col-md-3">
				<?= view('chunks/help/sidebar') ?>
			</div>
		</div>
	</div>
</div>
<div id="sucursales">
	<div class="container">
		<ol class="breadcrumb">
            <li><a href=""><i class="material-icons">home</i></a></li>
            <li><a href="/ayuda/">Centro de Ayuda</a></li>
            <li>Preguntas Frecuentes</li>
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
				<h2>Sucursales</h2>
				<offices-collapse :data="<?=e($offices)?>"></offices-collapse>
			</div>
			<div class="col-md-3">
				<?=view('chunks/help/sidebar')?>
			</div>
		</div>
	</div>
</div>
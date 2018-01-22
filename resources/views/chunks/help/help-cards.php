<div class="help-cards">
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-12">
            <a href="/ayuda/preguntas-frecuentes" class="help-card <?= Request::path() == 'ayuda/preguntas-frecuentes' ? 'active' : '' ?>" title="Ir a preguntas frecuentes">
                <div class="media">
                    <div class="media-left">
                        <i class="material-icons">help</i>
                    </div>
                    <div class="media-body">
                        <div class="media-heading">Preguntas Frecuentes</div>
                        <p>Revisa la lista de preguntas frecuentes.</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
        	<a href="/ayuda/sucursales" class="help-card <?= Request::path() == 'ayuda/sucursales' ? 'active' : '' ?>" title="ir a sucursales">
	            <div class="media">
	                <div class="media-left">
	                    <i class="material-icons">store</i>
	                </div>
	                <div class="media-body">
	                    <div class="media-heading">Sucursales</div>
	                    <p>Busca tu sucursal de ChileAtiende más cercana.</p>
	                </div>
	            </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
            <a href="/ayuda/atencion-telefonica" class="help-card <?= Request::path() == 'ayuda/atencion-telefonica' ? 'active' : '' ?>" title="Ir a atención telefónica">
                <div class="media">
                    <div class="media-left">
                        <i class="material-icons">perm_phone_msg</i>
                    </div>
                    <div class="media-body">
                        <div class="media-heading">Atención Telefónica</div>
                        <p>Aprende a utilizar el servicio de telefónica 101.</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
            <a href="/ayuda/oficinas-moviles" class="help-card <?= Request::path() == 'ayuda/oficinas-moviles' ? 'active' : '' ?>">
                <div class="media">
                    <div class="media-left">
                        <i class="material-icons">directions_bus</i>
                    </div>
                    <div class="media-body">
                        <div class="media-heading">Oficinas Móviles</div>
                        <p>Conoce la ubicación de nuestras oficinas móviles.</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
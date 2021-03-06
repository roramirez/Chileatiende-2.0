<footer id="footer" class="hidden-print">
    <div class="container">
        <div class="footer-desktop">
            <div class="row">
                <div class="col-sm-3">
                    <a class="toggle-footer collapsed" data-toggle="collapse" href="#foo-coll-01">
                        <h3>Sobre ChileAtiende</h3>
                        <span class="caret"></span>
                    </a>
                    <div id="foo-coll-01" class="links-footer collapse">
                        <ul>
                            <?php if(@$skin == 'exterior'):?>
                                <li><a href="/que-es-chileatiende?skin=exterior">Sobre ChileAtiende en el Exterior</a></li>
                                <li><a href="/ayuda/preguntas-frecuentes?skin=exterior" data-ga-te-category="Acciones" data-ga-te-action="Ayuda" data-ga-te-value="Footer">Preguntas Frecuentes (Exterior)</a></li>
                                <li><a href="http://www.chilevacontigo.gob.cl/">Servicios Disponibles en Consulados</a></li>
                                <li><a href="https://contacto.chilesinpapeleo.cl/tramites/iniciar/3280" target="_blank">Contacto</a></li>
                            <?php else: ?>
                                <li><a href="/que-es-chileatiende">Sobre ChileAtiende</a></li>
                                <li><a href="/ayuda/preguntas-frecuentes" data-ga-te-category="Acciones" data-ga-te-action="Ayuda" data-ga-te-value="Footer">Preguntas Frecuentes</a></li>
                                <li><a href="https://www.chileatiende.gob.cl/contacto/formulario.php?origen=http://www.chileatiende.gob.cl/" target="_blank">Contacto</a></li>
                            <?php endif ?>
                            <li><a href="/instituciones">Instituciones que publican en el Portal</a></li>
                            <li><a href="/ayuda/">Centro de Ayuda</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3">
                    <a class="toggle-footer collapsed" data-toggle="collapse" href="#foo-coll-02">
                        <h3>API para Desarrolladores</h3>
                        <span class="caret"></span>
                    </a>
                    <div id="foo-coll-02" class="links-footer collapse">
                        <ul>
                            <li><a href="/desarrolladores">API</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3">
                    <a class="toggle-footer collapsed" data-toggle="collapse" href="#foo-coll-03">
                        <h3>Accesos Directos</h3>
                        <span class="caret"></span>
                    </a>
                    <div id="foo-coll-03" class="links-footer collapse">
                        <ul>
       
                            <li><a href="?skin=exterior">ChileAtiende en el Exterior</a></li>
                            <li><a href="/enlaces-transparencia">Enlaces para transparencia activa</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3">
                    <a class="toggle-footer collapsed" data-toggle="collapse" href="#foo-coll-04">
                        <h3>Términos y Condiciones</h3>
                        <span class="caret"></span>
                    </a>
                    <div id="foo-coll-04" class="links-footer collapse">
                        <ul>
                            <li><a href="/politica-de-privacidad">Política de privacidad</a></li>
                            <li><a href="/terminos-y-condiciones">Términos de uso</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="contact-section">
                    <div class="col-sm-6">
                        <div class="hidden-xs hidden-sm">
                            <a href="/ayuda/atencion-telefonica"><img src="images/callcenter.svg" alt="callcenter" /></a>
                            <a href="/ayuda/atencion-telefonica">Callcenter 101</a>
                        </div>
                        <div class="hidden-md hidden-lg">
                            <a href="tel:101"><img src="images/callcenter.svg" alt="callcenter" /></a>
                            <a href="tel:101">Callcenter 101</a>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="text-right">
              
                        <?php if(@$skin == 'exterior'):?>
                            <a href="https://contacto.chilesinpapeleo.cl/tramites/iniciar/3280" target="_blank"><i class="material-icons email">email</i></a>
                        <?php else: ?>
                            <a href="https://www.chileatiende.gob.cl/contacto/formulario.php?origen=http://www.chileatiende.gob.cl/" target="_blank"><i class="material-icons email">email</i></a>
                        <?php endif ?>
                            
                            <a href="https://www.facebook.com/ChileAtiende" target="_blank"><img src="images/facebook.svg" alt="Facebook" /></a>
                            &nbsp;
                            <a href="https://twitter.com/ChileAtiende" target="_blank"><img src="images/twitter.svg" alt="Twitter" /></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-mobile">
            
        </div>
        <hr />
        <div>ChileAtiende es una marca registrada por: <br><a href="http://www.ips.gob.cl" target="_blank">Instituto de Previsión Social (MINTRAB)</a></div>
        <div>Portal desarrollado por: <br><a href="http://www.modernizacion.gob.cl" target="_blank">División de Gobierno Digital (MINSEGPRES)</a></div>
        <br />
        <div><a href="http://creativecommons.org/licenses/by/3.0/cl/" target="_blank"><img src="images/by.svg" /></a> <a href="http://creativecommons.org/licenses/by/3.0/cl/" target="_blank"><img src="images/cc.svg" /></a> A menos que se indique lo contrario, todo el contenido en ChileAtiende.gob.cl está bajo una licencia <a href="http://creativecommons.org/licenses/by/3.0/cl/" target="_blank">Creative Commons 3.0 (CC BY 3.0 CL)</a></div>
        <img class="gob" src="images/gob.svg" alt="Gobierno de Chile" />
        <div class="hidden-md hidden-lg">
            Crédito de la foto de portada: <a class="photo-credit" href="https://unsplash.com/@diegojimenez" target="_blank">Diego Jimenez</a>
        </div>
    </div>
</footer>

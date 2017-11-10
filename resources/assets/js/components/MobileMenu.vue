<template>
	<div class="mobile-menu-component">
		<div class="dropdown-link">
			<div class="menu-icon" v-bind:class="{ open: isOpen }" v-on:click="toggleMenu">
				<span></span>
				<span></span>
				<span></span>
			</div>
		</div>
		<transition name="dropdown" mode="out-in">
			<div class="dropdown-content" v-if="isOpen">
				<ul class="help-menu">
					<li v-if="user == null">
						<a href="mi-chileatiende">
							<div class="media mcha-mobile">
                                <div class="media-left">
									<svg width="27px" height="27px" viewBox="0 0 27 27" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
									    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
									        <g id="Home_mobile_v3_Menu" transform="translate(-18.000000, -100.000000)" fill-rule="nonzero" fill="#FFFFFF">
									            <path d="M26.3836527,101.463817 C21.6326353,103.396387 18.2835766,108.055281 18.2835766,113.495532 C18.2835766,120.667366 24.1038749,126.481286 31.2835766,126.481286 C38.4632784,126.481286 44.2835766,120.667366 44.2835766,113.495532 C44.2835766,108.037674 40.912805,103.366239 36.1373279,101.445139 L36.1373279,105.297576 C38.9387546,106.956151 40.81691,110.006748 40.81691,113.495532 C40.81691,118.754877 36.5486913,123.018418 31.2835766,123.018418 C26.018462,123.018418 21.7502433,118.754877 21.7502433,113.495532 C21.7502433,110.025951 23.607781,106.989745 26.3836527,105.325089 L26.3836527,101.463817 Z M29.6585766,107.245101 L29.6585766,100.481286 L32.9085766,100.481286 L32.9085766,107.258827 C35.2460399,107.964599 36.9479903,110.132716 36.9479903,112.697909 C36.9479903,115.835586 34.4016098,118.379176 31.2604903,118.379176 C28.1193708,118.379176 25.5729903,115.835586 25.5729903,112.697909 C25.5729903,110.115856 27.2973872,107.936115 29.6585766,107.245101 Z M31.2835766,115.538543 C32.8541364,115.538543 34.1273266,114.266748 34.1273266,112.697909 C34.1273266,111.129071 32.8541364,109.857276 31.2835766,109.857276 C29.7130169,109.857276 28.4398266,111.129071 28.4398266,112.697909 C28.4398266,114.266748 29.7130169,115.538543 31.2835766,115.538543 Z" id="Combined-Shape-Copy"></path>
									        </g>
									    </g>
									</svg>
                                </div>
                                <div class="media-body">
                                    <div class="media-heading">Acceder a Mi<br> ChileAtiende</div>
                                    <i class="material-icons">keyboard_arrow_right</i>
                                </div>
                            </div>
						</a>
					</li>
					<li v-if="user">
						<div class="media mcha-mobile">
                            <div class="media-left">
								<svg width="27px" height="27px" viewBox="0 0 27 27" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
								    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
								        <g id="Home_mobile_v3_Menu" transform="translate(-18.000000, -100.000000)" fill-rule="nonzero" fill="#FFFFFF">
								            <path d="M26.3836527,101.463817 C21.6326353,103.396387 18.2835766,108.055281 18.2835766,113.495532 C18.2835766,120.667366 24.1038749,126.481286 31.2835766,126.481286 C38.4632784,126.481286 44.2835766,120.667366 44.2835766,113.495532 C44.2835766,108.037674 40.912805,103.366239 36.1373279,101.445139 L36.1373279,105.297576 C38.9387546,106.956151 40.81691,110.006748 40.81691,113.495532 C40.81691,118.754877 36.5486913,123.018418 31.2835766,123.018418 C26.018462,123.018418 21.7502433,118.754877 21.7502433,113.495532 C21.7502433,110.025951 23.607781,106.989745 26.3836527,105.325089 L26.3836527,101.463817 Z M29.6585766,107.245101 L29.6585766,100.481286 L32.9085766,100.481286 L32.9085766,107.258827 C35.2460399,107.964599 36.9479903,110.132716 36.9479903,112.697909 C36.9479903,115.835586 34.4016098,118.379176 31.2604903,118.379176 C28.1193708,118.379176 25.5729903,115.835586 25.5729903,112.697909 C25.5729903,110.115856 27.2973872,107.936115 29.6585766,107.245101 Z M31.2835766,115.538543 C32.8541364,115.538543 34.1273266,114.266748 34.1273266,112.697909 C34.1273266,111.129071 32.8541364,109.857276 31.2835766,109.857276 C29.7130169,109.857276 28.4398266,111.129071 28.4398266,112.697909 C28.4398266,114.266748 29.7130169,115.538543 31.2835766,115.538543 Z" id="Combined-Shape-Copy"></path>
								        </g>
								    </g>
								</svg>
                            </div>
                            <div class="media-body">
                                <div class="media-heading">Bienvenido/a,<br>{{ user.first_name }}</div>
                            </div>
                        </div>
                        <div class="user-options">
                        	<a href="perfil">
                                <i class="material-icons">person</i>
                                Perfil
                            </a>
                            <a href="logout" @click.prevent="logout">
                            	<i class="material-icons">power_settings_new</i>
                                Cerrar Sesión
                            </a>
                        </div>
					</li>
					<li>
                        <a href="/que-es-chileatiende" class="help-card" title="Ir a qué es ChileAtiende">
                            <div class="media">
                                <div class="media-left what-is-it">
                                    <i class="material-icons">help</i>
                                </div>
                                <div class="media-body">
                                    <div class="media-heading">¿Qué es ChileAtiende?</div>
                                    <p>Información sobre la Guía de Trámites y Servicios del Estado.</p>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="/ayuda/preguntas-frecuentes" class="help-card" title="Ir a preguntas frecuentes">
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
                    </li>
                    <li>
	                    <a href="/ayuda/sucursales" class="help-card" title="ir a sucursales">
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
	                </li>
	                <li>
	                    <a href="/ayuda/atencion-telefonica" class="help-card" title="Ir a atención telefónica">
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
	                </li>
	                <li>
	                    <a href="/ayuda/oficinas-moviles" class="help-card">
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
	                </li>
                </ul>
			</div>
		</transition>
	</div>
</template>
<style lang="scss">
	$red: #ED3232;
	.menu-icon {
		position: relative;
		height: 30px;
		margin-top: 25px;
		margin-right: 20px;
		display: inline-block;
		span {
			height: 4px;
			width: 30px;
			background-color: $red;
			display: block;
			transition: .3s ease;
			&:nth-child(2) {
				margin-top: 4px;
			}
			&:nth-child(3) {
				margin-top: 4px;
			}
		}
		&.open {
			span {
				&:nth-child(1) {
					transform: rotate(45deg);
					margin-top: 6px;
				}
				&:nth-child(2) {
					opacity: 0;
				}
				&:nth-child(3) {
					transform: rotate(-45deg);
					margin-top: -12px;
				}
			}
		}
	}
	.dropdown-content {
		width: 100%;
		position: absolute;
		top: 70px;
		text-align: left;
		//transform: translate(0,0);
		box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.4);
		.help-menu {
			padding: 0;
			margin: 0;
			list-style-type: none;
			.media {
				width: 100%;
			}
			.mcha-mobile {
		      background-color: #004A96;
		      border-bottom: 0;
		      .media-left {
		      	vertical-align: middle;
		      }
		      .media-heading {
		      	color: #fff;
		      	margin: 0;
		      	line-height: 1.2;
		      }
		      .material-icons {
		      	position: absolute;
		    	right: 10px;
			    top: 25px;
			    color: #fff;
		      }
		    }
		    .user-options {
		      	a {
		      		display: block;
		      		color: #fff;
		      		background-color: #0053AB;
		      		border-bottom: 1px solid #00458D;
		      		padding: 13px;
		      		.material-icons {
		      			font-size: 20px;
		      			vertical-align: bottom;
		      		}
		      	}
	      	}
		}
	}
	.dropdown-enter-active, .dropdown-leave-active {
	  transition: .2s ease;
	}
	.dropdown-enter, .dropdown-leave-to {
	  opacity: 0;
	}
</style>
<script>
	export default {
		props: ['user'],
		data: function() {
			return {
				isOpen: false
			}
		},
		methods: {
			toggleMenu: function() {
				this.isOpen = ! this.isOpen;
			},
			logout() {
				this.$emit('logout');
			}
		}
	}
</script>
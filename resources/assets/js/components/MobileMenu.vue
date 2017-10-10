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
		background-color: green;
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
		data: function() {
			return {
				isOpen: false
			}
		},
		methods: {
			toggleMenu: function() {
				this.isOpen = ! this.isOpen;
			}
		}
	}
</script>
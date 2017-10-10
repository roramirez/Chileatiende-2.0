<template>
	<div class="sucursal-card-component">
		<div class="card">
			<div class="row">
				<div class="col-md-8">
					<div class="office-info">
						<div class="name">{{data.name}}</div>
						<div class="address">
							<div class="heading">
								<i class="material-icons">location_on</i>
								Dirección
							</div>
							<div class="value">
								<p>{{data.address}}</p>
							</div>
						</div>
						<div class="schedule">
							<div class="heading">
								<i class="material-icons">access_time</i>
								Horario de atención
							</div>
							<div class="value">
								<p>{{data.schedules}}</p>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<button class="main-btn white-btn" @click="displayMap = !displayMap">
						Ver Mapa
					</button>
				</div>
			</div>
			<office-map v-if="displayMap" :data="data"></office-map>
		</div>
	</div>
</template>
<script>
    import OfficeMap from './OfficeMap.vue';

	export default {
	    data: function(){
	        return{
	            displayMap: false,
            }
        },
		props: ['data'],
        components:{
            OfficeMap
        }
	}
</script>
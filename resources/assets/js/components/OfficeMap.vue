<template>
    <div class="google-maps"></div>
</template>
<style lang="scss" scoped>
    .google-maps{
        width: 100%;
        height: 310px;
    }
</style>
<script>
    var GoogleMapsLoader = require('google-maps');
    GoogleMapsLoader.KEY = 'AIzaSyA1XzVmhDUOJS3FSAZ0tjFJf1DFKk31Ro0';

    export default{
        props:['data'],
        mounted: function(){
            var self = this;

            var position = {lat: self.data.lat, lng: self.data.lng};

            GoogleMapsLoader.load(function(google) {
                var map = new google.maps.Map(self.$el, {
                    center: position,
                    zoom: 17
                });


                var marker = new google.maps.Marker({
                    position: position,
                    map: map,
                    title: self.data.name
                });

                var infowindow = new google.maps.InfoWindow({
                    content: '<table class="table">' +
                    '<tr><th>Punto de Atención</th><td>'+self.data.name+'</td></tr>' +
                    '<tr><th>Dirección</th><td>'+self.data.address+'</td></tr>' +
                    '<tr><th>Comuna</th><td>'+self.data.location.name+'</td></tr>' +
                    '<tr><th>Horario</th><td>'+self.data.schedules+'</td></tr>' +
                    '</table>'
                });

                marker.addListener('click', function() {
                    infowindow.open(map, marker);
                });
            });



        }
    }
</script>
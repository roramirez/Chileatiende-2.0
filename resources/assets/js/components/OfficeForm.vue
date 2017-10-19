<template>
    <form class="office-form form-horizontal" @submit.prevent="submit()">
        <div class="form-group" :class="{'has-error': errors['name']}">
            <label for="name" class="col-sm-2 control-label">Título</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" v-model="data.name">
                <div class="help-block" v-for="e in errors['name']">{{e}}</div>
            </div>
        </div>
        <div class="form-group" :class="{'has-error': errors['address']}">
            <label for="address" class="col-sm-2 control-label">Dirección</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="address" v-model="data.address">
                <div class="help-block" v-for="e in errors['address']">{{e}}</div>
            </div>
        </div>
        <div class="form-group" :class="{'has-error': errors['schedules']}">
            <label for="schedules" class="col-sm-2 control-label">Horario</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="schedules" v-model="data.schedules">
                <div class="help-block" v-for="e in errors['schedules']">{{e}}</div>
            </div>
        </div>
        <div class="form-group" :class="{'has-error': errors['phones']}">
            <label for="phones" class="col-sm-2 control-label">Teléfonos</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="phones" v-model="data.phones">
                <div class="help-block" v-for="e in errors['phones']">{{e}}</div>
            </div>
        </div>
        <div class="form-group" :class="{'has-error': errors['fax']}">
            <label for="fax" class="col-sm-2 control-label">Fax</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="fax" v-model="data.fax">
                <div class="help-block" v-for="e in errors['fax']">{{e}}</div>
            </div>
        </div>
        <div class="form-group" :class="{'has-error': errors['lat']}">
            <label for="lat" class="col-sm-2 control-label">Latitud</label>
            <div class="col-sm-10">
                <input type="number" step="0.000001" class="form-control" id="lat" v-model.number="data.lat">
                <div class="help-block" v-for="e in errors['lat']">{{e}}</div>
            </div>
        </div>
        <div class="form-group" :class="{'has-error': errors['lng']}">
            <label for="lng" class="col-sm-2 control-label">Longitud</label>
            <div class="col-sm-10">
                <input type="number" step="0.000001" class="form-control" id="lng" v-model.number="data.lng">
                <div class="help-block" v-for="e in errors['lng']">{{e}}</div>
            </div>
        </div>
        <div class="form-group" :class="{'has-error': errors['director']}">
            <label for="director" class="col-sm-2 control-label">Director</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="director" v-model="data.director">
                <div class="help-block" v-for="e in errors['director']">{{e}}</div>
            </div>
        </div>
        <div class="form-group" :class="{'has-error': errors['institution_id']}">
            <label for="institution_id" class="col-sm-2 control-label">Institución</label>
            <div class="col-sm-10">
                <institution-select id="institution_id" v-model="data.institution_id"></institution-select>
                <div class="help-block" v-for="e in errors['institution_id']">{{e}}</div>
            </div>
        </div>
        <div class="form-group" :class="{'has-error': errors['location_id']}">
            <label for="location_id" class="col-sm-2 control-label">Comuna</label>
            <div class="col-sm-10">
                <city-select id="location_id" v-model="data.location_id"></city-select>
                <div class="help-block" v-for="e in errors['location_id']">{{e}}</div>
            </div>
        </div>
        <div class="form-group" :class="{'has-error': errors['mobile']}">
            <label class="col-sm-2 control-label">¿Movil?</label>
            <div class="col-sm-10">
                <div class="radio">
                    <label><input type="radio" v-model="data.mobile" :value="true" /> Si</label>
                    <label><input type="radio" v-model="data.mobile" :value="false" /> No</label>
                </div>
                <div class="help-block" v-for="e in errors['mobile']">{{e}}</div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <a class="btn btn-default" href="backend/oficinas">Cancelar</a>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </form>
</template>
<style lang="scss" scoped>
    .el-select{
        display: block;
    }
</style>
<script>
    import InstitutionSelect from './InstitutionSelect.vue';
    import CitySelect from './CitySelect.vue';

    export default {
        data: function(){
            return{
                data: _.cloneDeep(this.office),
                errors: {}
            }
        },
        props: ['office','edit'],
        components:{
            InstitutionSelect,
            CitySelect
        },
        methods:{
            submit: function(){
                var self = this;

                axios({
                    url: self.edit ? 'backend/oficinas/'+self.data.id : 'backend/oficinas',
                    method: self.edit ? 'PUT' : 'POST',
                    data: self.data,
                }).then(function(response){
                    window.location.replace(response.data.redirect);
                }).catch(function(error){
                    self.errors = error.response.data.errors;
                });
            }
        }
    }
</script>
<template>
    <form class="access-token-form form-horizontal" @submit.prevent="submit()">

        <div class="form-group" :class="{'has-error': errors['published']}">
            <label for="email" class="col-sm-2 control-label">Correo Electrónico</label>
            <div class="col-sm-10">
                <input id="email" type="email" class="form-control" v-model="data.email" />
                <div class="help-block" v-for="e in errors['email']">{{e}}</div>
            </div>
        </div>

        <div class="form-group" :class="{'has-error': errors['published']}">
            <label for="first_name" class="col-sm-2 control-label">Nombre</label>
            <div class="col-sm-10">
                <input id="first_name" type="text" class="form-control" v-model="data.first_name" />
                <div class="help-block" v-for="e in errors['first_name']">{{e}}</div>
            </div>
        </div>

        <div class="form-group" :class="{'has-error': errors['published']}">
            <label for="last_name" class="col-sm-2 control-label">Apellidos</label>
            <div class="col-sm-10">
                <input id="last_name" type="text" class="form-control" v-model="data.last_name" />
                <div class="help-block" v-for="e in errors['last_name']">{{e}}</div>
            </div>
        </div>

        <div class="form-group" :class="{'has-error': errors['published']}">
            <label for="company" class="col-sm-2 control-label">Empresa</label>
            <div class="col-sm-10">
                <input id="company" type="text" class="form-control" v-model="data.company" />
                <div class="help-block" v-for="e in errors['company']">{{e}}</div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <a class="btn btn-default" href="desarrolladores">Cancelar</a>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </div>

    </form>
</template>
<style lang="scss">
    .access-token-form{

    }
</style>
<script>
    import ElSwitch from 'element-ui/lib/switch';
    import InstitutionSelect from './InstitutionSelect.vue';
    import CategoriesSelect from './CategoriesSelect.vue';

    export default {
        data: function(){
            return{
                data: {
                    email: '',
                    first_name: '',
                    last_name: '',
                    company: ''
                },
                errors: {}
            }
        },
        methods:{
            submit: function(){
                var self = this;

                axios({
                    url: 'desarrolladores/access_token',
                    method: 'POST',
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
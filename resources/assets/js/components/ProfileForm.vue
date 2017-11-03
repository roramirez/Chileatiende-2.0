<template>
    <form class="category-form form-horizontal" @submit.prevent="submit()">
        <div class="form-group" :class="{'has-error': errors['first_name']}">
            <label for="first_name" class="col-sm-2 control-label">Nombres</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="first_name" v-model="data.first_name">
                <div class="help-block" v-for="e in errors['first_name']">{{e}}</div>
            </div>
        </div>
        <div class="form-group" :class="{'has-error': errors['last_name']}">
            <label for="last_name" class="col-sm-2 control-label">Apellidos</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="last_name" v-model="data.last_name">
                <div class="help-block" v-for="e in errors['last_name']">{{e}}</div>
            </div>
        </div>
        <div class="form-group" :class="{'has-error': errors['email']}">
            <label for="email" class="col-sm-2 control-label">E-Mail</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="email" v-model="data.email">
                <div class="help-block" v-for="e in errors['email']">{{e}}</div>
            </div>
        </div>


        <div class="help-block">Solamente llenar estos campos si se desea cambiar la contraseña</div>

        <div class="form-group" :class="{'has-error': errors['password']}">
            <label for="password" class="col-sm-2 control-label">Contraseña</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="password" v-model="data.password">
                <div class="help-block" v-for="e in errors['password']">{{e}}</div>
            </div>
        </div>
        <div class="form-group" :class="{'has-error': errors['password_confirmation']}">
            <label for="password_confirmation" class="col-sm-2 control-label">Confirmar Contraseña</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="password_confirmation" v-model="data.password_confirmation">
                <div class="help-block" v-for="e in errors['password_confirmation']">{{e}}</div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <a class="btn btn-default" href="backend/categorias">Cancelar</a>
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

    export default {
        data: function(){
            var data = _.cloneDeep(this.user);
            data.password = '';
            data.password_confirmation = '';

            return{
                data: data,
                errors: {}
            }
        },
        props: ['user','edit'],
        methods:{
            submit: function(){
                var self = this;

                axios({
                    url: 'backend/perfil',
                    method: 'PUT',
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
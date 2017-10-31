<template>
    <form class="category-form form-horizontal" @submit.prevent="submit()">
        <div class="form-group" :class="{'has-error': errors['name']}">
            <label for="name" class="col-sm-2 control-label">Nombre</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" v-model="data.name">
                <div class="help-block" v-for="e in errors['name']">{{e}}</div>
            </div>
        </div>
        <div class="form-group" :class="{'has-error': errors['email']}">
            <label for="email" class="col-sm-2 control-label">E-Mail</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="email" v-model="data.email">
                <div class="help-block" v-for="e in errors['email']">{{e}}</div>
            </div>
        </div>
        <div class="form-group" :class="{'has-error': errors['role']}">
            <label for="role" class="col-sm-2 control-label">Rol</label>
            <div class="col-sm-10">
                <select id="role" class="form-control" v-model="data.role">
                    <option>admin</option>
                    <option>editor</option>
                </select>
                <div class="help-block" v-for="e in errors['role']">{{e}}</div>
            </div>
        </div>
        <div class="form-group" :class="{'has-error': errors['institution_id']}">
            <label for="institution_id" class="col-sm-2 control-label">Institución</label>
            <div class="col-sm-10">
                <institution-select id="institution_id" v-model="data.institution_id"></institution-select>
                <div class="help-block" v-for="e in errors['institution_id']">{{e}}</div>
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
    import InstitutionSelect from './InstitutionSelect.vue';

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
        components:{
            InstitutionSelect
        },
        methods:{
            submit: function(){
                var self = this;

                axios({
                    url: self.edit ? 'backend/usuarios/'+self.data.id : 'backend/usuarios',
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
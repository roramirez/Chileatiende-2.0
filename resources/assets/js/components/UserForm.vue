<template>
    <form class="category-form form-horizontal" @submit.prevent="submit()">
        <div class="form-group" :class="{'has-error': errors['first_name']}">
            <label for="first_name" class="col-sm-2 control-label">Nombre</label>
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
        <div class="form-group" :class="{'has-error': errors['role']}">
            <label for="role" class="col-sm-2 control-label">Rol</label>
            <div class="col-sm-10">
                <select id="role" class="form-control" v-model="data.role">
                    <option>admin</option>
                    <option>counterpart</option>
                    <option>operator</option>
                </select>
                <div class="help-block">
                    <ul>
                        <li><strong>admin:</strong> Permisos para todo</li>
                        <li><strong>counterpart:</strong> Permisos solo para editar fichas. Normalmente usuario asignado a instituciones para que colaboren en la edición de fichas.</li>
                        <li><strong>operator:</strong> Permisos para editar oficinas mobiles.</li>
                    </ul>
                </div>
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
        <div class="form-group" :class="{'has-error': errors['ministerial']}">
            <label for="ministerial" class="col-sm-2 control-label">Ministerial</label>
            <div class="col-sm-10">
                <el-switch id="ministerial" v-model="data.ministerial"></el-switch>
                <div class="help-block" v-for="e in errors['ministerial']">{{e}}</div>
            </div>
        </div>
        <div class="form-group" :class="{'has-error': errors['interministerial']}">
            <label for="interministerial" class="col-sm-2 control-label">InterMinisterial</label>
            <div class="col-sm-10">
                <el-switch id="interministerial" v-model="data.interministerial"></el-switch>
                <div class="help-block" v-for="e in errors['interministerial']">{{e}}</div>
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
                <a class="btn btn-default" href="backend/usuarios">Cancelar</a>
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
    import ElSwitch from 'element-ui/lib/switch';

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
            InstitutionSelect,
            ElSwitch
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
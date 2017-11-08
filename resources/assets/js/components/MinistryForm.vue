<template>
    <form class="ministry-form form-horizontal" @submit.prevent="submit()">
        <div class="form-group" :class="{'has-error': errors['name']}">
            <label for="name" class="col-sm-2 control-label">Nombre</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" v-model="data.name">
                <div class="help-block" v-for="e in errors['name']">{{e}}</div>
            </div>
        </div>
        <div class="form-group" :class="{'has-error': errors['shortname']}">
            <label for="shortname" class="col-sm-2 control-label">Nombre Corto</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="shortname" v-model="data.shortname">
                <div class="help-block" v-for="e in errors['shortname']">{{e}}</div>
            </div>
        </div>
        <div class="form-group" :class="{'has-error': errors['description']}">
            <label for="description" class="col-sm-2 control-label">Descripción</label>
            <div class="col-sm-10">
                <textarea class="form-control" id="description" v-model="data.description" rows="5"></textarea>
                <div class="help-block" v-for="e in errors['description']">{{e}}</div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <a class="btn btn-default" href="backend/ministerios">Cancelar</a>
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
            return{
                data: _.cloneDeep(this.ministry),
                errors: {}
            }
        },
        props: ['ministry','edit'],
        methods:{
            submit: function(){
                var self = this;

                axios({
                    url: self.edit ? 'backend/ministerios/'+self.data.id : 'backend/ministerios',
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
<template>
    <form class="office-form form-horizontal" @submit.prevent="submit()">
        <div class="form-group" :class="{'has-error': errors['name']}">
            <label for="name" class="col-sm-2 control-label">Título</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" @blur="refreshAlias" v-model="data.name">
                <div class="help-block" v-for="e in errors['name']">{{e}}</div>
            </div>
        </div>
        <div class="form-group" :class="{'has-error': errors['address']}">
            <label for="address" class="col-sm-2 control-label">Dirección</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="address" @blur="refreshAlias" v-model="data.address">
                <div class="help-block" v-for="e in errors['address']">{{e}}</div>
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
<style lang="scss">

</style>
<script>

    export default {
        data: function(){
            return{
                data: _.cloneDeep(this.office),
                errors: {}
            }
        },
        props: ['office','edit'],
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
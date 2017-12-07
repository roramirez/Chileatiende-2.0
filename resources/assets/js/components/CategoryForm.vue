<template>
    <form class="category-form form-horizontal" @submit.prevent="submit()">
        <div class="form-group" :class="{'has-error': errors['name']}">
            <label for="name" class="col-sm-2 control-label">Nombre</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" v-model="data.name">
                <div class="help-block" v-for="e in errors['name']">{{e}}</div>
            </div>
        </div>

        <div class="form-group" :class="{'has-error': errors['featured']}">
            <label for="featured" class="col-sm-2 control-label">¿Destacada?</label>
            <div class="col-sm-10">
                <el-switch id="featured" v-model="data.featured" on-text="Sí" off-text="No"></el-switch>
                <div class="help-block" v-for="e in errors['featured']">{{e}}</div>
            </div>
        </div>

        <div class="form-group" :class="{'has-error': errors['exterior']}">
            <label for="exterior" class="col-sm-2 control-label">¿Destacada para Chilenos en el Exterior?</label>
            <div class="col-sm-10">
                <el-switch id="exterior" v-model="data.exterior" on-text="Sí" off-text="No"></el-switch>
                <div class="help-block" v-for="e in errors['exterior']">{{e}}</div>
            </div>
        </div>

        <div class="form-group" :class="{'has-error': errors['order']}">
            <label for="order" class="col-sm-2 control-label">Orden</label>
            <div class="col-sm-2">
                <input type="number" id="order" class="form-control" v-model.number="data.order" />
                <div class="help-block" v-for="e in errors['order']">{{e}}</div>
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
    import ElSwitch from 'element-ui/lib/switch';

    export default {
        data: function(){
            return{
                data: _.cloneDeep(this.category),
                errors: {}
            }
        },
        props: ['category','edit'],
        components: {
            ElSwitch
        },
        methods:{
            submit: function(){
                var self = this;

                axios({
                    url: self.edit ? 'backend/categorias/'+self.data.id : 'backend/categorias',
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
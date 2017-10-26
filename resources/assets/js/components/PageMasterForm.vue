<template>
    <form class="page-form form-horizontal" @submit.prevent="submit()">

        <div class="form-group" :class="{'has-error': errors['published']}">
            <label for="published" class="col-sm-2 control-label">Publicado</label>
            <div class="col-sm-10">
                <el-switch id="published" v-model="data.published" on-text="Si" off-text="No"></el-switch>
                <div class="help-block" v-for="e in errors['published']">{{e}}</div>
            </div>
        </div>

        <div class="form-group" :class="{'has-error': errors['featured']}">
            <label for="featured" class="col-sm-2 control-label">Destacado</label>
            <div class="col-sm-10">
                <el-switch id="featured" v-model="data.featured" on-text="Si" off-text="No"></el-switch>
                <div class="help-block" v-for="e in errors['featured']">{{e}}</div>
            </div>
        </div>

        <div class="form-group" :class="{'has-error': errors['featured']}">
            <label for="featured" class="col-sm-2 control-label">Boosting</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" v-model.number="data.boost" />
                <div class="help-block" v-for="e in errors['featured']">{{e}}</div>
                <div class="help-block">Boosting multiplicador en búsquedas.<br />Un valor de 1 (Por defecto) deja el puntaje de busqueda igual. Un valor 2 lo multiplica por 2 y asi sucesivamente.</div>
            </div>
        </div>

        <div class="form-group" :class="{'has-error': errors['institution_id']}">
            <label for="institution_id" class="col-sm-2 control-label">Institución</label>
            <div class="col-sm-10">
                <institution-select id="institution_id" v-model="data.institution_id"></institution-select>
                <div class="help-block" v-for="e in errors['institution_id']">{{e}}</div>
            </div>
        </div>

        <div class="form-group" :class="{'has-error': errors['categories']}">
            <label for="categories" class="col-sm-2 control-label">Categorías</label>
            <div class="col-sm-10">
                <categories-select id="categories" v-model="data.categories"></categories-select>
                <div class="help-block" v-for="e in errors['categories']">{{e}}</div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <a class="btn btn-default" href="backend/fichas">Cancelar</a>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </form>
</template>
<style lang="scss">
    .page-form{
        .el-select{
            display: block;
        }
        .el-upload{
            .el-upload__input{
                display: none;
            }
        }
    }
</style>
<script>
    import ElSwitch from 'element-ui/lib/switch';
    import InstitutionSelect from './InstitutionSelect.vue';
    import CategoriesSelect from './CategoriesSelect.vue';

    export default {
        data: function(){
            return{
                data: _.cloneDeep(this.page),
                errors: {}
            }
        },
        props: ['page'],
        components:{
            ElSwitch,
            InstitutionSelect,
            CategoriesSelect
        },
        methods:{
            submit: function(){
                var self = this;

                axios({
                    url: 'backend/fichas/'+self.data.id+'/master',
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
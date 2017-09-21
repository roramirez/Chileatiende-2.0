<template>
    <form class="form-horizontal" @submit.prevent="submit()">
        <div class="form-group" :class="{'has-error': errors['title']}">
            <label for="title" class="col-sm-2 control-label">Título</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="title" v-model="data.title">
                <div class="help-block" v-for="e in errors['title']">{{e}}</div>
            </div>
        </div>

        <div class="form-group" :class="{'has-error': errors['institution_id']}">
            <label for="institution_id" class="col-sm-2 control-label">Institución</label>
            <div class="col-sm-10">
                <institution-select id="institution_id" v-model="data.institution_id"></institution-select>
                <div class="help-block" v-for="e in errors['institution_id']">{{e}}</div>
            </div>
        </div>

        <div class="form-group" :class="{'has-error': errors['objective']}">
            <label for="objective" class="col-sm-2 control-label">Descripción</label>
            <div class="col-sm-10">
                <!--<textarea class="form-control" id="objective" v-model="data.objective"></textarea>-->
                <vue-quill-editor id="objective" v-model="data.objective"></vue-quill-editor>
                <div class="help-block" v-for="e in errors['objective']">{{e}}</div>
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
<script>
    var InstitutionSelect = require('./InstitutionSelect.vue');
    var VueQuillEditor = require('vue-quill-editor').quillEditor;

    export default {
        data: function(){
            return{
                data: _.cloneDeep(this.page),
                errors: {}
            }
        },
        props: ['page'],
        components:{
            InstitutionSelect,
            VueQuillEditor
        },
        methods:{
            submit: function(){
                var self = this;

                axios({
                    url: 'backend/fichas/'+self.data.id,
                    method: 'PUT',
                    data: self.data,
                }).then(function(response){
                    window.location.replace('backend/fichas');
                }).catch(function(error){
                    self.errors = error.response.data.errors;
                });
            }
        }
    }
</script>
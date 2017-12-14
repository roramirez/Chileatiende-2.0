<template>
    <form class="category-form form-horizontal" @submit.prevent="submit()">
        <div class="form-group" :class="{'has-error': errors['institution_id']}">
            <label for="institution_id" class="col-sm-2 control-label">Remitente</label>
            <div class="col-sm-10">
                <institution-select id="institution_id" v-model="data.institution_id"></institution-select>
                <div class="help-block" v-for="e in errors['institution_id']">{{e}}</div>
            </div>
        </div>
        <div class="form-group" :class="{'has-error': errors['title']}">
            <label for="title" class="col-sm-2 control-label">Título</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="title" v-model="data.title">
                <div class="help-block" v-for="e in errors['title']">{{e}}</div>
            </div>
        </div>
        <div class="form-group" :class="{'has-error': errors['message']}">
            <label for="message" class="col-sm-2 control-label">Mensaje</label>
            <div class="col-sm-10">
                <editor id="message" v-model="data.message"></editor>
                <div class="help-block" v-for="e in errors['message']">{{e}}</div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <a class="btn btn-default" href="backend">Cancelar</a>
                <button type="submit" class="btn btn-primary">Enviar</button>
            </div>
        </div>
    </form>
</template>
<style lang="scss" scoped>

</style>
<script>
    import InstitutionSelect from './InstitutionSelect.vue';
    import Editor from './Editor.vue';

    export default {
        data: function(){
            return{
                data: {
                    title: '',
                    message: '',
                    institution_id: null
                },
                errors: {}
            }
        },
        components:{
            InstitutionSelect,
            Editor
        },
        methods:{
            submit: function(){
                var self = this;

                axios({
                    url: 'backend/notificaciones',
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
<template>
    <form class="form-horizontal" @submit.prevent="submit()">
        <div class="form-group" :class="{'has-error': errors['title']}">
            <label for="title" class="col-sm-2 control-label">Título</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="title" v-model="data.title">
                <div class="help-block" v-for="e in errors['title']">{{e}}</div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </form>
</template>
<script>
    export default {
        data: function(){
            return{
                data: _.cloneDeep(this.page),
                errors: {}
            }
        },
        props: ['page'],
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
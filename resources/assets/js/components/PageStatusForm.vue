<template>
    <form @submit.prevent="submit">
        <div class="text-center">
            <button v-if="data.status == 'en_revision'" class="btn btn-primary">Enviar a Revisión</button>
            <button v-else class="btn btn-primary" @click.prevent='dialogVisible = true'>Observaciones</button>
        </div>


        <el-dialog title="Observaciones" :visible.sync="dialogVisible" size="tiny">
            <div class="form-group">
                <label>Justificación</label>
                <textarea v-if="data.status == 'rechazado'" v-model="data.status_comment" class="form-control" rows="5" placeholder="Escriba la justificación del rechazo."></textarea>
            </div>
            <span slot="footer" class="dialog-footer">
                <button @click.prevent="dialogVisible = false" class="btn">Cancelar</button>
                <button class="btn btn-primary" @click.prevent="submit">Enviar</button>
            </span>
        </el-dialog>
    </form>
</template>
<script>

    import ElDialog from 'element-ui/lib/dialog';

    export default {
        data: function(){

            var status = '';
            if(!this.page.status || this.page.status == 'rechazado')
                status = 'en_revision';
            else{
                status = 'rechazado';
            }

            return{

                dialogVisible: false,
                data: {
                    status: status,
                    status_comment: ''
                },
                errors: {}
            }
        },
        props: ['page'],
        components:{
            ElDialog
        },
        methods:{
            submit: function(){
                var self = this;

                axios({
                    url: 'backend/fichas/'+self.page.id+'/status',
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
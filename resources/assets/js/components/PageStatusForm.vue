<template>
    <form @submit.prevent>
        <div class="text-center">
            <template v-if="page.status == 'en_revision'">
                <button class="btn btn-success" @click.prevent='data.action = "publish"; submit();'>Aprobar y Publicar</button>
                <button class="btn btn-primary" @click.prevent='data.action = "reject"; dialogVisible = true;'>Rechazar con observaciones</button>
            </template>
            <template v-else>
                <button class="btn btn-success" @click.prevent='data.action = "revise"; submit();'>Enviar a Revisión</button>
            </template>
            <button v-if="page.published" class="btn btn-danger" @click.prevent='data.action = "unpublish"; dialogVisible = true;'>Despublicar</button>



            <!--
            <button v-if="page.status == ''  || page.status == 'rechazado'" class="btn btn-primary" @click.prevent="submit('en_revision')">Enviar a Revisión</button>
            <template v-else>
                <button class="btn btn-success" @click.prevent='submit()'>Aprobar y Publicar</button>
                <button class="btn btn-primary" @click.prevent='dialogVisible = true'>Rechazar con observaciones</button>
                <button class="btn btn-danger">Despublicar</button>
            </template>
            -->
            
        </div>


        <el-dialog title="Observaciones" :visible.sync="dialogVisible" size="tiny">
            <div class="form-group">
                <label>Justificación</label>
                <textarea v-model="data.status_comment" class="form-control" rows="5" placeholder="Escriba la justificación del rechazo."></textarea>
            </div>
            <span slot="footer" class="dialog-footer">
                <button @click.prevent="dialogVisible = false" class="btn">Cancelar</button>
                <button class="btn btn-primary" @click.prevent="submit()">Enviar</button>
            </span>
        </el-dialog>
    </form>
</template>
<script>

    import ElDialog from 'element-ui/lib/dialog';

    export default {
        data: function(){
            return{

                dialogVisible: false,
                data: {
                    action: null,
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
                    data: {
                        action: self.data.action,
                        status_comment: self.data.status_comment
                    },
                }).then(function(response){
                    window.location.replace(response.data.redirect);
                }).catch(function(error){
                    self.errors = error.response.data.errors;
                });
            }
        }
    }
</script>
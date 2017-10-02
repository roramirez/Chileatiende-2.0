<template>
    <form class="page-form form-horizontal" @submit.prevent="submit()">
        <div class="form-group" :class="{'has-error': errors['title']}">
            <label for="title" class="col-sm-2 control-label">Título</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="title" v-model="data.title">
                <div class="help-block" v-for="e in errors['title']">{{e}}</div>
            </div>
        </div>

        <div class="form-group" :class="{'has-error': errors['image']}">
            <label for="image" class="col-sm-2 control-label">Imagen</label>
            <div class="col-sm-10">
                <el-upload action="backend/api/files" :headers="{'X-CSRF-TOKEN': token, 'X-Requested-With': 'XMLHttpRequest'}" :on-change="imageUploadChanged" :show-file-list="false">
                    <el-button size="small" type="primary">Click para subir imagen</el-button>
                </el-upload>
                <br />
                <input id="image" type="url" class="form-control" v-model="data.image" />
                <div class="help-block">URL de la imagen</div>
                <div class="help-block" v-for="e in errors['image']">{{e}}</div>
            </div>
        </div>

        <div class="form-group" :class="{'has-error': errors['objective']}">
            <label for="objective" class="col-sm-2 control-label">Descripción</label>
            <div class="col-sm-10">
                <editor id="objective" v-model="data.objective"></editor>
                <div class="help-block" v-for="e in errors['objective']">{{e}}</div>
            </div>
        </div>

        <div class="form-group" :class="{'has-error': errors['details']}">
            <label for="details" class="col-sm-2 control-label">Detalles</label>
            <div class="col-sm-10">
                <editor id="details" v-model="data.details"></editor>
                <div class="help-block" v-for="e in errors['details']">{{e}}</div>
            </div>
        </div>

        <div class="form-group" :class="{'has-error': errors['beneficiaries']}">
            <label for="beneficiaries" class="col-sm-2 control-label">Beneficiarios</label>
            <div class="col-sm-10">
                <editor id="beneficiaries" v-model="data.beneficiaries"></editor>
                <div class="help-block" v-for="e in errors['beneficiaries']">{{e}}</div>
            </div>
        </div>

        <div class="form-group" :class="{'has-error': errors['requirements']}">
            <label for="requirements" class="col-sm-2 control-label">Requerimientos</label>
            <div class="col-sm-10">
                <editor id="requirements" v-model="data.requirements"></editor>
                <div class="help-block" v-for="e in errors['requirements']">{{e}}</div>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">Guías</label>

            <div class="col-sm-10">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#online" aria-controls="online" role="tab" data-toggle="tab"><input @click.stop="" type="checkbox" v-model="data.online" /> Online</a></li>
                    <li role="presentation"><a href="#office" aria-controls="office" role="tab" data-toggle="tab"><input @click.stop="" type="checkbox" v-model="data.office" /> Oficina</a></li>
                    <li role="presentation"><a href="#phone" aria-controls="phone" role="tab" data-toggle="tab"><input @click.stop="" type="checkbox" v-model="data.phone" /> Telefónico</a></li>
                    <li role="presentation"><a href="#mail" aria-controls="mail" role="tab" data-toggle="tab"><input @click.stop="" type="checkbox" v-model="data.mail" /> Correo</a></li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="online">
                        <editor v-model="data.online_guide"></editor>
                        <div class="help-block" v-for="e in errors['online_guide']">{{e}}</div>
                        <br />
                        <label>URL trámite en línea</label>
                        <input type="text" class="form-control" id="online_url" v-model="data.online_url">
                        <div class="help-block" v-for="e in errors['online_url']">{{e}}</div>

                    </div>
                    <div role="tabpanel" class="tab-pane" id="office">
                        <editor v-model="data.office_guide"></editor>
                        <div class="help-block" v-for="e in errors['office_guide']">{{e}}</div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="phone">
                        <editor v-model="data.phone_guide"></editor>
                        <div class="help-block" v-for="e in errors['phone_guide']">{{e}}</div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="mail">
                        <editor v-model="data.mail_guide"></editor>
                        <div class="help-block" v-for="e in errors['mail_guide']">{{e}}</div>
                    </div>
                </div>
            </div>

        </div>

        <div class="form-group" :class="{'has-error': errors['keywords']}">
            <label for="keywords" class="col-sm-2 control-label">Keywords</label>
            <div class="col-sm-10">
                <textarea id="keywords" class="form-control" rows="5" v-model="data.keywords"></textarea>
                <div class="help-block" v-for="e in errors['keywords']">{{e}}</div>
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
    import ElUpload from 'element-ui/lib/upload';
    import ElButton from 'element-ui/lib/button';
    import Editor from './Editor.vue';

    export default {
        data: function(){
            return{
                data: _.cloneDeep(this.page),
                token: window.token.content,
                errors: {}
            }
        },
        props: ['page','edit'],
        components:{
            ElUpload,
            ElButton,
            Editor
        },
        methods:{
            submit: function(){
                var self = this;

                axios({
                    url: self.edit ? 'backend/fichas/'+self.data.id : 'backend/fichas',
                    method: self.edit ? 'PUT' : 'POST',
                    data: self.data,
                }).then(function(response){
                    window.location.replace(response.data.redirect);
                }).catch(function(error){
                    self.errors = error.response.data.errors;
                });
            },
            imageUploadChanged: function(file){
                if(file.status == "success"){
                    this.data.image = file.response;
                }else if (file.status == "fail"){
                    alert("No se pudo subir archivo");
                }
            }
        }
    }
</script>
<template>
    <form class="page-form form-horizontal" @submit.prevent="submit()">
        <div class="form-group" :class="{'has-error': errors['title']}">
            <label for="title" class="col-sm-2 control-label">Título
                <a v-if="comments.title" v-tooltip :title="comments.title" href="#" @click.prevent><i class="material-icons">comment</i></a>
            </label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="title" @blur="refreshAlias" v-model="data.title" @input="showComments.title = true">
                <div class="help-block" v-for="e in errors['title']">{{e}}</div>
                <field-comments v-if="showComments.title" v-model="data.comments.title"></field-comments>
            </div>
        </div>

        <div class="form-group" :class="{'has-error': errors['alias']}">
            <label for="alias" class="col-sm-2 control-label">Alias</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="alias" v-model="data.alias">
                <div class="help-block" v-for="e in errors['alias']">{{e}}</div>
            </div>
        </div>

        <div class="form-group" :class="{'has-error': errors['published_at']}">
            <label for="published_at" class="col-sm-2 control-label">Fecha de actualización</label>
            <div class="col-sm-10">
                <el-date-picker id="published_at" v-model="data.published_at" type="date" format="dd-MM-yyyy" :picker-options="{firstDayOfWeek: 1}" placeholder="Seleccione una fecha"></el-date-picker>
                <div class="help-block">Fecha que aparecerá en la ficha del portal</div>
                <div class="help-block" v-for="e in errors['published_at']">{{e}}</div>
            </div>
        </div>

        <div class="form-group" :class="{'has-error': errors['image']}">
            <label for="image" class="col-sm-2 control-label">Imagen</label>
            <div class="col-sm-10">
                <el-upload action="backend/api/files" :headers="{'X-CSRF-TOKEN': token, 'X-Requested-With': 'XMLHttpRequest'}" :on-change="imageUploadChanged" :show-file-list="false">
                    <el-button size="small" type="primary">Click para subir imagen</el-button>
                </el-upload>
                <br />
                <input id="image" type="text" class="form-control" v-model="data.image" placeholder="Ej: http://www.ejemplo.com/imagen.jpg" />
                <div class="help-block">URL de la imagen</div>
                <div class="help-block" v-for="e in errors['image']">{{e}}</div>
            </div>
        </div>

        <div class="form-group" :class="{'has-error': errors['objective']}">
            <label for="objective" class="col-sm-2 control-label">Descripción
                <a v-if="comments.objective" v-tooltip :title="comments.objective" href="#" @click.prevent><i class="material-icons">comment</i></a>
            </label>
            <div class="col-sm-10">
                <editor id="objective" v-model="data.objective" @input="showComments.objective = true"></editor>
                <div class="help-block" v-for="e in errors['objective']">{{e}}</div>
                <field-comments v-if="showComments.objective" v-model="data.comments.objective"></field-comments>
            </div>
        </div>

        <div class="form-group" :class="{'has-error': errors['details']}">
            <label for="details" class="col-sm-2 control-label">Detalles
                <a v-if="comments.details" v-tooltip :title="comments.details" href="#" @click.prevent><i class="material-icons">comment</i></a>
            </label>
            <div class="col-sm-10">
                <editor id="details" v-model="data.details" @input="showComments.details = true"></editor>
                <div class="help-block" v-for="e in errors['details']">{{e}}</div>
                <field-comments v-if="showComments.details" v-model="data.comments.details"></field-comments>
            </div>
        </div>

        <div class="form-group" :class="{'has-error': errors['beneficiaries']}">
            <label for="beneficiaries" class="col-sm-2 control-label">Beneficiarios
                <a v-if="comments.beneficiaries" v-tooltip :title="comments.beneficiaries" href="#" @click.prevent><i class="material-icons">comment</i></a>
            </label>
            <div class="col-sm-10">
                <editor id="beneficiaries" v-model="data.beneficiaries" @input="showComments.beneficiaries = true"></editor>
                <div class="help-block" v-for="e in errors['beneficiaries']">{{e}}</div>
                <field-comments v-if="showComments.beneficiaries" v-model="data.comments.beneficiaries"></field-comments>
            </div>
        </div>

        <div class="form-group" :class="{'has-error': errors['requirements']}">
            <label for="requirements" class="col-sm-2 control-label">Requerimientos
                <a v-if="comments.requirements" v-tooltip :title="comments.requirements" href="#" @click.prevent><i class="material-icons">comment</i></a>
            </label>
            <div class="col-sm-10">
                <editor id="requirements" v-model="data.requirements" @input="showComments.requirements = true"></editor>
                <div class="help-block" v-for="e in errors['requirements']">{{e}}</div>
                <field-comments v-if="showComments.requirements" v-model="data.comments.requirements"></field-comments>
            </div>
        </div>

        <div class="form-group" :class="{'has-error': errors['cost']}">
            <label for="cost" class="col-sm-2 control-label">Costo
                <a v-if="comments.cost" v-tooltip :title="comments.cost" href="#" @click.prevent><i class="material-icons">comment</i></a>
            </label>
            <div class="col-sm-10">
                <editor id="cost" v-model="data.cost" @input="showComments.cost = true"></editor>
                <div class="help-block" v-for="e in errors['cost']">{{e}}</div>
                <field-comments v-if="showComments.cost" v-model="data.comments.cost"></field-comments>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">Guías</label>

            <div class="col-sm-10">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#online" aria-controls="online" role="tab" data-toggle="tab">
                            <input @click.stop="" type="checkbox" v-model="data.online" /> Online
                            <span v-if="comments.online_guide" v-tooltip :title="comments.online_guide" href="#" @click.prevent><i class="material-icons">comment</i></span>
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#office" aria-controls="office" role="tab" data-toggle="tab">
                            <input @click.stop="" type="checkbox" v-model="data.office" /> Oficina
                            <span v-if="comments.office_guide" v-tooltip :title="comments.office_guide" href="#" @click.prevent><i class="material-icons">comment</i></span>
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#phone" aria-controls="phone" role="tab" data-toggle="tab">
                            <input @click.stop="" type="checkbox" v-model="data.phone" /> Telefónico
                            <span v-if="comments.phone_guide" v-tooltip :title="comments.phone_guide" href="#" @click.prevent><i class="material-icons">comment</i></span>
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#mail" aria-controls="mail" role="tab" data-toggle="tab">
                            <input @click.stop="" type="checkbox" v-model="data.mail" /> Correo
                            <span v-if="comments.mail_guide" v-tooltip :title="comments.mail_guide" href="#" @click.prevent><i class="material-icons">comment</i></span>
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#consulate" aria-controls="consulate" role="tab" data-toggle="tab">
                            <input @click.stop="" type="checkbox" v-model="data.consulate" /> Consulado
                            <span v-if="comments.consulate_guide" v-tooltip :title="comments.consulate_guide" href="#" @click.prevent><i class="material-icons">comment</i></span>
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="online">
                        <editor v-model="data.online_guide" @input="showComments.online_guide = true"></editor>
                        <div class="help-block" v-for="e in errors['online_guide']">{{e}}</div>
                        <field-comments v-if="showComments.online_guide" v-model="data.comments.online_guide"></field-comments>
                        <br />
                        <label>URL trámite en línea</label>
                        <input type="text" class="form-control" id="online_url" v-model="data.online_url">
                        <div class="help-block" v-for="e in errors['online_url']">{{e}}</div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="office">
                        <editor v-model="data.office_guide" @input="showComments.office_guide = true"></editor>
                        <div class="help-block" v-for="e in errors['office_guide']">{{e}}</div>
                        <field-comments v-if="showComments.office_guide" v-model="data.comments.office_guide"></field-comments>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="phone">
                        <editor v-model="data.phone_guide" @input="showComments.phone_guide = true"></editor>
                        <div class="help-block" v-for="e in errors['phone_guide']">{{e}}</div>
                        <field-comments v-if="showComments.phone_guide" v-model="data.comments.phone_guide"></field-comments>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="mail">
                        <editor v-model="data.mail_guide" @input="showComments.mail_guide = true"></editor>
                        <div class="help-block" v-for="e in errors['mail_guide']">{{e}}</div>
                        <field-comments v-if="showComments.mail_guide" v-model="data.comments.mail_guide"></field-comments>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="consulate">
                        <editor v-model="data.consulate_guide" @input="showComments.consulate_guide = true"></editor>
                        <div class="help-block" v-for="e in errors['consulate_guide']">{{e}}</div>
                        <field-comments v-if="showComments.consulate_guide" v-model="data.comments.consulate_guide"></field-comments>

                    </div>
                </div>
            </div>

        </div>

        <div class="form-group" :class="{'has-error': errors['legal']}">
            <label for="legal" class="col-sm-2 control-label">Marco Legal
                <a v-if="comments.legal" v-tooltip :title="comments.legal" href="#" @click.prevent><i class="material-icons">comment</i></a>
            </label>
            <div class="col-sm-10">
                <editor id="legal" v-model="data.legal" @input="showComments.legal = true"></editor>
                <div class="help-block" v-for="e in errors['legal']">{{e}}</div>
                <field-comments v-if="showComments.legal" v-model="data.comments.legal"></field-comments>
            </div>
        </div>

        <div class="form-group" :class="{'has-error': errors['keywords']}">
            <label for="keywords" class="col-sm-2 control-label">Keywords</label>
            <div class="col-sm-10">
                <textarea id="keywords" class="form-control" rows="5" v-model="data.keywords"></textarea>
                <div class="help-block" v-for="e in errors['keywords']">{{e}}</div>
            </div>
        </div>

        <div class="form-group" :class="{'has-error': errors['related_pages']}">
            <label for="related_pages" class="col-sm-2 control-label">Fichas Relacionadas</label>
            <div class="col-sm-10">
                <pages-select id="related_pages" v-model="data.related_pages"></pages-select>
                <div class="help-block" v-for="e in errors['related_pages']">{{e}}</div>
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
        .field-comments{
            margin-top: 10px;
        }
    }
</style>
<script>
    import ElDatePicker from 'element-ui/lib/date-picker';
    import ElUpload from 'element-ui/lib/upload';
    import ElButton from 'element-ui/lib/button';
    import Tooltip from '../directives/Tooltip';
    import Editor from './Editor.vue';
    import PagesSelect from './PagesSelect.vue';
    import FieldComments from './FieldComments.vue';

    export default {
        data: function(){
            const page = _.cloneDeep(this.page);
            const comments = _.cloneDeep(this.page.comments);
            this.page.comments = {};

            return{
                data: page,
                showComments: {},
                comments: comments,
                token: window.token.content,
                errors: {}
            }
        },
        props: ['page','edit'],
        components:{
            ElDatePicker,
            ElUpload,
            ElButton,
            Editor,
            PagesSelect,
            FieldComments
        },
        directives:{
            Tooltip
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
            refreshAlias: function(){
                if(!this.data.alias)
                    this.data.alias = _.kebabCase(this.data.title);
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
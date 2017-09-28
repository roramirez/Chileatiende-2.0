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
<script>
    var InstitutionSelect = require('./InstitutionSelect.vue');
    var Editor = require('./Editor.vue');

    export default {
        data: function(){
            return{
                data: _.cloneDeep(this.page),
                errors: {}
            }
        },
        props: ['page','edit'],
        components:{
            InstitutionSelect,
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
            }
        }
    }
</script>
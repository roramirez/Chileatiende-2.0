<template>
    <form class="content-form form-horizontal" @submit.prevent="submit()">
        <div class="form-group" :class="{'has-error': errors['title']}">
            <label for="title" class="col-sm-2 control-label">Título</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="title" v-model="data.title" required>
                <div class="help-block" v-for="e in errors['title']">{{e}}</div>
            </div>
        </div>

        <div class="form-group" :class="{'has-error': errors['url']}">
            <label for="url" class="col-sm-2 control-label">Url</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="url" v-model="data.url">
                <div class="help-block" v-for="e in errors['url']">{{e}}</div>
            </div>
        </div>

        <div class="form-group" :class="{'has-error': errors['content']}">
            <label for="content" class="col-sm-2 control-label">Contenido</label>
            <div class="col-sm-10">
                <textarea class="form-control" id="content" cols="30" rows="10" v-model="data.content"
                          required></textarea>
                <div class="help-block" v-for="e in errors['content']">{{e}}</div>
            </div>
        </div>

        <div class="form-group" :class="{'has-error': errors['published']}">
            <label for="published" class="col-sm-2 control-label">¿Publicada?</label>
            <div class="col-sm-10">
                <el-switch id="published" v-model="data.published" on-text="Sí" off-text="No"></el-switch>
                <div class="help-block" v-for="e in errors['published']">{{e}}</div>
            </div>
        </div>

        <div class="form-group" :class="{'has-error': errors['template']}">
            <label for="template" class="col-sm-2 control-label">Plantilla</label>
            <div class="col-sm-10">
                <select class="form-control" id="template" v-model="data.template">
                    <option :value="template" v-for="template in templates" v-text="template"></option>
                </select>
                <div class="help-block" v-for="e in errors['template']">{{e}}</div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <a class="btn btn-default" href="backend/contenidos">Cancelar</a>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </form>
</template>
<style lang="scss" scoped>
    .el-select {
        display: block;
    }
</style>
<script>
    import ElSwitch from 'element-ui/lib/switch';

    export default {
        data: function () {
            return {
                data: _.cloneDeep(this.content),
                errors: {}
            }
        },
        props: ['content', 'templates', 'edit'],
        components: {
            ElSwitch
        },
        methods: {
            submit: function () {
                axios({
                    url: this.edit ? 'backend/contenidos/' + this.data.id : 'backend/contenidos',
                    method: this.edit ? 'PUT' : 'POST',
                    data: this.data,
                }).then((response) => {
                    window.location.replace(response.data.redirect);
                }).catch((error) => {
                    this.errors = error.response.data.errors;
                });
            }
        }
    }
</script>
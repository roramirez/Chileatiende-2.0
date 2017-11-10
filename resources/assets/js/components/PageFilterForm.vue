<template>
    <form class="page-filter-form">
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label">Ministerio</label>
                    <ministry-select v-model="data.ministry_id"></ministry-select>
                    <input type="hidden" name="ministry_id" :value="data.ministry_id" />
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label">Institución</label>
                    <institution-select v-model="data.institution_id"></institution-select>
                    <input type="hidden" name="institution_id" :value="data.institution_id" />
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label">Búsqueda</label>
            <input type="text" class="form-control" v-model="data.query" name="query" placeholder="Ej: bono marzo" />
        </div>

            <div class="text-right">
                <button type="submit" class="btn btn-primary">Filtrar</button>
            </div>
    </form>
</template>
<style lang="scss">
    .page-filter-form{
        .el-select{
            display: block;
        }
    }

</style>
<script>
    import MinistrySelect from './MinistrySelect.vue';
    import InstitutionSelect from './InstitutionSelect.vue';

    export default{
        data: function(){
            var data = {
                query: '',
                ministry_id: null,
                institution_id: null
            };

            return {
                data: _.assign(data, this.filters)
            }
        },
        props: ['filters'],
        components:{
            MinistrySelect,
            InstitutionSelect
        }
    }
</script>
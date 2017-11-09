<template>
    <div class="search">
        <el-autocomplete v-model="query" :name="name" :autofocus="true" :trigger-on-focus="false" :fetch-suggestions="querySearchAsync" placeholder="Ej: Certificado de nacimiento" @select="handleSelect">
            <el-button ref="caca" slot="append" native-type="submit"><img src="../../images/search.svg" /> Buscar</el-button>
        </el-autocomplete>
    </div>
</template>
<script>
    import ElAutocomplete from 'element-ui/lib/autocomplete';
    import ElButton from 'element-ui/lib/button';

    export default {
        data: function(){
            return {
                query: this.value,
            }
        },
        props: ['name','value'],
        components: {
            ElAutocomplete,
            ElButton
        },
        methods:{
            querySearchAsync: _.debounce(function(queryString, cb){
                var self = this;

                axios.get('api/suggest?query=' + this.query)
                    .then(function(response) {
                        var results = response.data.map(function (d) {
                            return {
                                value: d.text
                            };
                        });

                        cb(results);
                    })
            },1000,{leading: true}),
            handleSelect: function(item){
                var self = this;

                Vue.nextTick(function(){
                    self.$el.querySelector('button').click();
                });
            }
        }
    }
</script>

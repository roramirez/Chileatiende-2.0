<template>
    <el-select multiple filterable remote :remote-method="remoteMethod" :loading="loading" v-model="data">
        <el-option v-for="c in pages" :label="c.title + ' (id: '+c.id+')'" :value="c.id" :key="c.id"></el-option>
    </el-select>
</template>
<script>
    import ElSelect from 'element-ui/lib/select';
    import ElOption from 'element-ui/lib/option';

    export default{
        data: function(){
            return{
                data: this.value,
                pages:[],
                loading: false
            }
        },
        props: ['value'],
        components:{
            ElSelect,
            ElOption
        },
        watch:{
            data: function(value){
                this.$emit('input', value);
            }
        },
        methods:{
            remoteMethod: _.debounce(function(query){
                var self = this;

                self.loading = true;
                axios.get('backend/api/pages?query=' + query)
                    .then(function(response) {
                        self.pages = response.data;
                        self.loading = false;
                    })
            },1000,{leading: true}),
        },
        mounted: function(){
            var self = this;

            this.data.forEach(function(d){
                axios.get('backend/api/pages/'+d)
                    .then(function(response){
                        self.pages.push(response.data);
                    });
            });
        }
    }
</script>
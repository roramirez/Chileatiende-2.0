<template>
    <el-select filterable v-model="cityId">
        <el-option v-for="i in cities" :key="i.id" :label="i.name" :value="i.id"></el-option>
    </el-select>
</template>
<script>
    import ElSelect from 'element-ui/lib/select';
    import ElOption from 'element-ui/lib/option';

    export default{
        data: function(){
            return{
                cityId: this.value,
                cities:[]
            }
        },
        props: ['value'],
        components:{
            ElSelect,
            ElOption
        },
        watch:{
            cityId: function(value){
                this.$emit('input', value);
            }
        },
        mounted: function(){
            var self = this;

            axios.get('backend/api/locations?type=comuna')
                .then(function(response){
                    self.cities = _.orderBy(response.data, 'name');
                });
        }
    }
</script>
<template>
    <el-select filterable clearable v-model="institutionId">
        <el-option v-for="i in institutions" :key="i.id" :label="i.name" :value="i.id"></el-option>
    </el-select>
</template>
<script>
    import ElSelect from 'element-ui/lib/select';
    import ElOption from 'element-ui/lib/option';

    export default{
        data: function(){
            return{
                institutionId: this.value,
                institutions:[]
            }
        },
        props: ['value'],
        components:{
            ElSelect,
            ElOption
        },
        watch:{
            institutionId: function(value){
                this.$emit('input', value);
            }
        },
        mounted: function(){
            var self = this;

            axios.get('backend/api/institutions')
                .then(function(response){
                    self.institutions = response.data;
                });
        }
    }
</script>
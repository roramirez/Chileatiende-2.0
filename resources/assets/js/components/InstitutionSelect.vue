<template>
    <el-select filterable v-model="institutionId">
        <el-option v-for="i in institutions" :key="i.id" :label="i.name" :value="i.id"></el-option>
    </el-select>
</template>
<script>
    export default{
        data: function(){
            return{
                institutionId: this.value,
                institutions:[]
            }
        },
        props: ['value'],
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
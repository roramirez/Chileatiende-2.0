<template>
    <el-select multiple filterable v-model="data">
        <el-option v-for="c in categories" :label="c.name" :value="c.id" :key="c.id"></el-option>
    </el-select>
</template>
<script>
    export default{
        data: function(){
            return{
                data: this.value,
                categories:[]
            }
        },
        props: ['value'],
        watch:{
            data: function(value){
                this.$emit('input', value);
            }
        },
        mounted: function(){
            var self = this;

            axios.get('backend/api/categories')
                .then(function(response){
                    self.categories = response.data;
                });
        }
    }
</script>
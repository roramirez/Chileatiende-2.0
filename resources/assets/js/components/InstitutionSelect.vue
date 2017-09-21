<template>
    <select class="form-control" v-model="institutionId">
        <option v-for="i in institutions" :value="i.id">{{i.name}}</option>
    </select>
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
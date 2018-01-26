<template>
    <div class="field-comments">
        <a href="#" @click.prevent="show = !show"><span class="material-icons">comment</span> Click aquí para comentar respecto a los cambios</a>
        <textarea v-if="show" class="form-control" v-model="data" rows="5"></textarea>
    </div>
</template>
<style lang="scss" scoped>
    @import '../../sass/variables';
    .field-comments{
        a{
            display: block;
            background: rgba($yellow, 0.8);
            border-radius: 5px;
            padding: 5px;
            color: $black;
            font-size: 10px;
            margin-bottom: 10px;
            .material-icons{
                font-size: 10px;
            }
            &:hover, &:focus{
                text-decoration: none;
            }
        }
    }
</style>
<script>
    export default {
        data: function(){
            return {
                show: false,
                data: this.value
            }
        },
        props: ['value'],
        watch: {
            data: function(data){
                this.$emit('input', data)
            }
        }
    }
</script>
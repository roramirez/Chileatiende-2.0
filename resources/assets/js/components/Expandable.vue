<template>
    <div class="expandable">
        <a class="truncate-button" href="#" @click.prevent="truncated = !truncated">{{truncated ? 'Expandir' : 'Contraer'}} <i class="material-icons">{{truncated ? 'expand_more' : 'expand_less'}}</i></a>
        <h5>{{title}}</h5>
        <div v-html="truncatedContent"></div>
    </div>
</template>
<style lang="scss" scoped>
    .expandable{
        position: relative;
        >.truncate-button{
            position: absolute;
            top: 10px;
            right: 10px;
        }
    }
</style>
<script>
    import truncate from 'html-truncate';

    export default{
        data: function(){
            return {
                truncated: true
            }
        },
        props: ['maxLength','title','content'],
        computed:{
            truncatedContent: function(){
                if(!this.truncated)
                    return this.content;

                return truncate(this.content, this.maxLength);
            }
        }
    }
</script>
<template>
    <el-collapse v-model="activeNames">
        <el-collapse-item v-for="(d,key) in groupedData" :title="d[0].location.parent.parent.name" :name="d[0].location.parent.parent.id" :key="key">
            <office-card v-for="d2 in d" :data="d2" :key="d2.id"></office-card>
        </el-collapse-item>
    </el-collapse>
</template>
<style lang="scss">
    .el-collapse {
        border: 0;
    }
    .el-collapse-item__wrap {
        background-color: transparent;
    }
    .el-collapse-item__content {
        padding: 0;
    }
</style>
<script>
    import ElCollapse from 'element-ui/lib/collapse';
    import ElCollapseItem from 'element-ui/lib/collapse-item';
    import OfficeCard from './OfficeCard.vue';

    export default {
        components: {
            ElCollapse,
            ElCollapseItem,
            OfficeCard
        },
        data() {
            return {
                activeNames: ['01']
            };
        },
        props: ['data'],
        computed:{
            groupedData: function(){
                return _(this.data)
                    .groupBy(function(d){
                        return d.location.parent.parent.id;
                    })
                    .values()
                    .orderBy(function(d){
                        return d[0].location.parent.parent.id;
                    })
                    .value();
            }
        }
    }
</script>
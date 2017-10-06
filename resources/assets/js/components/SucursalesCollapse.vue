<template>
<el-collapse v-model="activeNames">
  <el-collapse-item title="Región Metropolitana de Santiago" name="1">
    <sucursal-card></sucursal-card>
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
  import SucursalCard from './SucursalCard.vue';

  export default {
    components: {
        ElCollapse,
        ElCollapseItem,
        SucursalCard
    },
    data() {
      return {
        activeNames: ['1']
      };
    }
  }
</script>
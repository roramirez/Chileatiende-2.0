<template>
    <div class="past-users panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-sm-3">
                    <h4>Estadísticas históricas</h4>
                    <h5>{{procedureId ? 'Ficha ChileAtiende' : 'Portal ChileAtiende'}}</h5>
                </div>
                <div class="col-sm-2">
                    <select v-if="showTypePicker" class="form-control" v-model="type">
                        <option value="activeUsers">Visitas únicas</option>
                        <option value="derivatedUsers">Derivaciones al trámite</option>
                    </select>
                </div>
                <div class="col-sm-4">
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default" :class="{active: period == 'date'}" @click="period = 'date'">Por Día</button>
                        <button type="button" class="btn btn-default" :class="{active: period == 'yearMonth'}" @click="period = 'yearMonth'">Por mes</button>
                        <button type="button" class="btn btn-default" :class="{active: period == 'year'}" @click="period = 'year'">Por Año</button>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="text-right">
                        <el-date-picker v-if="showDatePicker" v-model="range" format="dd-MM-yyyy" type="daterange" :clearable="false" range-separator=" / "></el-date-picker>
                    </div>
                </div>
            </div>

        </div>
        <div class="panel-body">
            <div ref="chartWrapper">
                <area-chart v-show="!loading" :data="data[type]" :height="chartHeight"
                            :width="chartWidth" :y-tick-format="yTickFormat" style="width: 100%;"></area-chart>
            </div>
            <div class="loader" v-show="loading">
                <img src="../../images/loader.svg" alt="Cargando..." />
            </div>
        </div>
    </div>
</template>
<style lang="scss" rel="stylesheet/scss">
    @import "../../sass/variables";

    .past-users{
        .panel-heading {
            .el-date-editor{
                width: 100%;
            }
            .btn-group {

            }
        }
        .panel-body{
            padding: 14px;
            min-height: 330px;
            .loader{
                text-align: center;
            }
        }
    }


</style>
<script>
    import ElDatePicker from 'element-ui/lib/date-picker';
    import AreaChart from './AreaChart.vue';

    export default {
        data: function(){
            return {
                refreshInterval: 60*60*1000,
                type: 'activeUsers',
                data: {
                    activeUsers: [],
                    derivatedUsers: []
                },
                range: [moment(this.start).toDate(),moment(this.end).toDate()],
                period: 'yearMonth',
                loading: true,
                chartWidth: 810,
                chartHeight: 400
            }
        },
        props:{
            procedureId: {default: null},
            showDatePicker: {default: true},
            showTypePicker: {default: true},
            start: {default: moment().subtract(2,'year').format('YYYY-MM-DD')},
            end: {default: moment().format('YYYY-MM-DD')}
        },
        components:{
            AreaChart,
            ElDatePicker
        },
        computed:{
            yTickFormat: function(){
                if(this.period == 'year')
                    return 'YYYY';
                else if (this.period == 'yearMonth')
                    return 'MMM YY';
                else
                    return 'DD-MM-YY';
            }
        },
        methods: {
            refresh: function(){
                var self = this;

                var url = 'backend/api/analytics/ga?start='+moment(self.range[0]).format('YYYY-MM-DD')+'&end='+moment(self.range[1]).format('YYYY-MM-DD')+'&metric=ga:uniquePageviews,ga:uniqueEvents&dimensions=ga:'+self.period;
                if(this.procedureId)
                    url += '&filters=ga:pagePath=~^/fichas/ver/'+this.procedureId+'$';

                self.loading = true;
                axios.get(url)
                    .then(function(response){
                        self.data.activeUsers = response.data.rows
                            .map(function(d){
                                return {
                                    date: moment(d[0],'YYYYMMDD').toDate(),
                                    value: 1 * d[1]
                                }
                            });
                        self.loading = false;
                    });



            }
        },
        watch:{
            range: function(){
                this.refresh();
            },
            period: function(){
                this.refresh();
            }
        },
        mounted: function(){
            var self = this;

            self.refresh();

        }
    }
</script>

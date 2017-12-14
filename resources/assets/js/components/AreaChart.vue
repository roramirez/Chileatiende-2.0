<template>
        <svg class="area-chart" :width="width" :height="height" :viewBox="'0 0 '+width+' '+height">
            <defs>
                <linearGradient x1="53.1691595%" y1="102.685254%" x2="53.1691611%" y2="45.5346704%" id="linearGradient-1">
                    <stop stop-color="#50BEF7" offset="0%"></stop>
                    <stop stop-color="#2A94F0" offset="100%"></stop>
                </linearGradient>
            </defs>

            <g :transform="'translate('+margin.left+','+margin.top+')'">
                <g class="yAxis" ref="yAxis"></g>
                <g class="xAxis" ref="xAxis" :transform="'translate(0,'+chartHeight+')'"></g>
                <g>
                    <path :d="d" fill="url(#linearGradient-1)"></path>
                    <path :d="lineD" fill="none" stroke="#1D92E0" stroke-width="2" stroke-linecap="round"
                          stroke-linejoin="round"></path>
                </g>
                <g>
                    <g v-for="d in data" @mouseenter="selectedItem = d" @mouseleave="selectedItem = null" v-tooltip :title="numeral(d.value).format('0,0') + '<br /><strong>Visitas</strong>'">
                        <circle r="6"
                                :cx="x(d.date)" :cy="y(d.value)" fill="#FFFFFF" :opacity="d == selectedItem ? 1 : 0"></circle>
                        <circle r="4" :cx="x(d.date)" :cy="y(d.value)" fill="#1D92E0" :opacity="d == selectedItem ? 1 : 0"></circle>
                    </g>
                </g>
            </g>

        </svg>
</template>
<style lang="scss" rel="stylesheet/scss">
    @import "../../sass/variables";
    .area-chart{
            .xAxis{
                .tick{
                    text{
                        fill: #7f8080;
                        font-size: 10px;
                    }
                    line{
                        stroke: #006BB0;
                    }
                }
                .domain{
                    stroke: #B5B6B5;
                }
            }
            .yAxis{
                .tick{
                    text{
                        fill: #7f8080;
                        font-size: 10px;
                    }
                    line{
                        stroke: #F5F4F4;
                    }
                }
                .domain{
                    display: none;
                }
            }
            circle{
                cursor: pointer;
            }

    }
</style>
<script>
    var d3 = require('d3');
    var Tooltip = require('../directives/Tooltip.js');

    export default{
        data: function(){
            return {
                margin: {top: 10, left: 30, right: 0, bottom: 20},
                animated:{
                    yScale: 0
                },
                selectedItem: null
            }
        },
        directives:{
            Tooltip
        },
        props: {
            data:{},
            width:{},
            height:{},
            yTickFormat:{
                default: "MMM YY"
            }
        },
        computed:{
            chartWidth: function(){
                return this.width - this.margin.left - this.margin.right;
            },
            chartHeight: function(){
                return this.height - this.margin.top - this.margin.bottom;
            },
            x: function(){
                return d3.scaleTime()
                    .rangeRound([0, this.chartWidth])
                    .domain(d3.extent(this.data, function(d){return d.date;}));
            },
            y: function(){
                return d3.scaleLinear()
                    .rangeRound([this.chartHeight, 0])
                    .domain([0, d3.max(this.data, function(d) { return d.value; })])
                    .nice();
            },
            area: function(){
                var self = this;

                return d3.area()
                    .x(function(d) { return self.x(d.date); })
                    .y1(function(d) { return self.y(d.value); })
                    .y0(this.y(0));
            },
            d: function(){
                return this.area(this.data);
            },
            line: function(){
                var self = this;

                return d3.line()
                    .x(function(d) { return self.x(d.date); })
                    .y(function(d) { return self.y(d.value); });
            },
            lineD: function(){
                return this.line(this.data);
            },
            axisLeft: function(){
                return d3.axisLeft(this.y)
                    .tickSize(-this.chartWidth)
                    .tickFormat(function(d){return numeral(d).format('0a')});
            },
            axisBottom: function(){
                var self=this;
                return d3.axisBottom(this.x)
                    .tickFormat(function(d){return moment(d).format(self.yTickFormat)});
            }
        },
        methods:{
            //resize: function(){
            //    this.width = this.$el.getBoundingClientRect().width;
            //    this.height = this.$el.getBoundingClientRect().height;
            //},
            generateAxis: function(){
                d3.select(this.$refs.yAxis).call(this.axisLeft);
                d3.select(this.$refs.xAxis).call(this.axisBottom);
            },
            numeral: numeral
        },
        watch:{
            data: {
                immediate: true,
                handler:function(value, oldValue){
                    this.generateAxis();


                }
            },
            width: function(){
                this.generateAxis();
            }
        },
        mounted: function(){
            var self = this;

            //this.resize();
            //new ResizeSensor(this.$el, function() {
            //    self.resize();
            //});


        }
    }
</script>
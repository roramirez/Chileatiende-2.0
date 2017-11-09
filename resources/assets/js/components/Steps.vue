<template>
    <div class="steps">
        <div class="row">
            <div class="col-sm-3 col">
                <div class="terms" id="terms-list">
                    <div class="item" v-for="(t,index) in terms" @click="selectedIndex = index" :class="{active: selectedIndex == index}" v-html="t"></div>
                </div>
            </div>
            <div class="col-sm-9 col">
                <div class="definitions" id="definitions-container">
                    <div v-for="(d,index) in definitions" v-html="d" v-show="selectedIndex == index"></div>
                </div>
            </div>
        </div>
    </div>
</template>
<style lang="scss" scoped>
    .steps{
        .col{
            .terms{
                padding-left: 0;
                border: 1px solid #ccc;
                @media (min-width: 768px) {
                    border-right: 0;
                }
                .item {
                    cursor: pointer;
                    padding: 10px;
                    border-bottom: 1px solid #ccc;
                    transition: .2s ease;
                    font-weight: normal;
                    font-size: 18px;
                    color: #757575;
                    &.active, &:hover {
                        background-color: #ED3232;
                        color: #fff;
                    }
                    &:last-child{
                        border-bottom: none;
                    }
                }
            }
            .definitions{
                padding: 20px;
                border: 1px solid #ccc;
                >li{
                    padding: 10px;
                }
            }
            @media (min-width: 768px) {
                &:first-child{
                    padding-right: 0;
                }
                &:last-child{
                    padding-left: 0;
                }
            }
        }
    }
</style>
<script>
    export default{
        data: function(){
            return {
                selectedIndex: 0,
                listHeight: null
            }
        },
        props: ['terms','definitions'],
        mounted() {
            this.listHeight = document.getElementById('terms-list').offsetHeight;
            $('#definitions-container').attr("style", "min-height:" + this.listHeight + "px");
        }
    }
</script>
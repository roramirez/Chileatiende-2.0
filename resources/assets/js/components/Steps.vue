<template>
    <div class="steps">
        <div class="row">
            <div class="col-sm-3 col">
                <ul class="terms">
                    <li v-for="(t,index) in terms" @click="selectedIndex = index" :class="{active: selectedIndex == index}">{{t}}</li>
                </ul>
            </div>
            <div class="col-sm-9 col">
                <ul class="definitions">
                    <li v-for="(d,index) in definitions" v-html="d" v-show="selectedIndex == index"></li>
                </ul>
            </div>
        </div>
    </div>
</template>
<style lang="scss" scoped>
    .steps{
        .col{
            ul.terms{
                list-style: none;
                padding-left: 0;
                border: 1px solid #ccc;
                >li{
                    cursor: pointer;
                    padding: 10px;
                    border-bottom: 1px solid #ccc;
                    &.active{
                        font-weight: bold;
                    }
                    &:last-child{
                        border-bottom: none;
                    }
                }
            }
            ul.definitions{
                list-style: none;
                padding-left: 0;
                border: 1px solid #ccc;
                border-left: 0;
                >li{
                    padding: 10px;
                }
            }
            &:first-child{
                padding-right: 0;
            }
            &:last-child{
                padding-left: 0;
            }
        }

    }
</style>
<script>
    export default{
        data: function(){
            return {
                selectedIndex: 0
            }
        },
        props: ['terms','definitions']
    }
</script>
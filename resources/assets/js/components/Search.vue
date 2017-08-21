<template>
    <div class="search dropdown" :class="{open: suggestions.length > 0}">
        <div class="input-group">
            <input v-model="query" @input="changed()" :name="name" type="search" class="form-control" placeholder="¿Que trámite o servicios buscas?" autocomplete="off"
                   @keyup="suggestKeyUp">
            <span class="input-group-btn">
                            <button class="btn btn-default" type="submit" ref="submitButton">Buscar</button>
                        </span>
        </div>
        <ul class="dropdown-menu" ref="dropdownMenu">
            <li v-for="s in suggestions"><a href="#" @click.prevent="selectSuggestion(s.text)">{{s.text}}</a></li>
        </ul>
    </div>
</template>
<style lang="scss" scoped>
    .search{
        position: relative;

    }
</style>
<script>
    export default {
        data: function(){
            return {
                query: this.value,
                suggestions: []
            }
        },
        props: ['name','value'],
        methods:{
            changed: function(){
                if(this.query.length >= 1)
                    this.refreshSuggestions();
                else
                    this.suggestions = [];
            },
            refreshSuggestions: _.debounce(function(){
                var self = this;

                axios.get('api/suggest?query=' + this.query)
                    .then(function(response) {
                        self.suggestions = response.data;
                    })
            },1000,{leading: true}),
            selectSuggestion: function(suggestion){
                var self = this;

                this.query = suggestion;

                Vue.nextTick(function(){
                    self.$refs.submitButton.click();
                });

            },
            suggestKeyUp: function (event) {
                var self = this;

                if (event.keyCode == 40) {    //Si es que se apreto la flecha abajo
                    self.$refs.dropdownMenu.querySelector('li:first-child a').focus();
                    return;
                }

                //if (event.keyCode == 13) {   //Si apreto enter
                //    event.target.blur();
                //    return;
                //}

                //self.suggest();
            }
        }
    }
</script>

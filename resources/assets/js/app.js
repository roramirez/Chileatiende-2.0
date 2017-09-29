
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/* Element UI */

import ElementUI from 'element-ui'
import 'element-ui/lib/theme-default/index.css'
import locale from 'element-ui/lib/locale/lang/es'
Vue.use(ElementUI, { locale });

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */



var SelectFirstTab = require('./directives/SelectFirstTab');
var Search = require('./components/Search.vue');
var Steps = require('./components/Steps.vue');
var PageForm = require('./components/PageForm.vue');

const app = new Vue({
    el: '#app',
    components:{
        Search,
        Steps,
        PageForm
    },
    directives:{
        SelectFirstTab
    },
    mounted: function(){
        var searchInput = document.querySelector('#search input');
        if(searchInput)
            searchInput.focus();
    }
});


/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';

import Vue from 'vue';
window.Vue = Vue;

/* Element UI */

import 'element-ui/lib/theme-default/index.css';
import Select from 'element-ui/lib/select';
import Option from 'element-ui/lib/option';
import lang from 'element-ui/lib/locale/lang/es';
import locale from 'element-ui/lib/locale';
locale.use(lang);
Vue.component(Select.name, Select);
Vue.component(Option.name, Option);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */



import SelectFirstTab from './directives/SelectFirstTab';
import Search from './components/Search.vue';
import Steps from './components/Steps.vue';
import PageForm from './components/PageForm.vue';

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

import './bootstrap';

window.gumshoe = require('gumshoe');
window.SmoothScroll = require('smooth-scroll');


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import SelectFirstTab from './directives/SelectFirstTab';
import Search from './components/Search.vue';
import Steps from './components/Steps.vue';
import ProfileCharacterizationForm from './components/ProfileCharacterizationForm.vue';
import OfficesCollapse from './components/OfficesCollapse.vue';
import MobileMenu from './components/MobileMenu.vue';
import PageNav from './components/PageNav.vue';
import TransparencyList from './components/TransparencyList.vue';
import Expandable from './components/Expandable.vue';

const app = new Vue({
    el: '#app',
    components:{
        Search,
        Steps,
        ProfileCharacterizationForm,
        OfficesCollapse,
        MobileMenu,
        PageNav,
        TransparencyList,
        Expandable,
    },
    directives:{
        SelectFirstTab
    },
    mounted() {
        var scroll = new SmoothScroll('.sidebar-menu a[href*="#"]', {
            header: 'mobile-heading'
        });
        var indexScroll = new SmoothScroll('.index-container a[href*="#"]', {
            offset: 100
        });
        $('[data-toggle="tooltip"]').tooltip();
    }
});

/* globals SmoothScroll, Vue, $ */
import './bootstrap';
import SelectFirstTab from './directives/SelectFirstTab';
import Search from './components/Search.vue';
import Steps from './components/Steps.vue';
import ProfileCharacterizationForm from './components/ProfileCharacterizationForm.vue';
import OfficesCollapse from './components/OfficesCollapse.vue';
import MobileMenu from './components/MobileMenu.vue';
import PageNav from './components/PageNav.vue';
import TransparencyList from './components/TransparencyList.vue';
import Expandable from './components/Expandable.vue';
import ResizableElementsMixin from './mixins/ResizableElements.js';

window.gumshoe = require('gumshoe');
window.SmoothScroll = require('smooth-scroll');

const app = new Vue({
    el: '#app',
    components: {
        Search,
        Steps,
        ProfileCharacterizationForm,
        OfficesCollapse,
        MobileMenu,
        PageNav,
        TransparencyList,
        Expandable
    },
    directives: {
        SelectFirstTab
    },
    mixins: [
        ResizableElementsMixin
    ],
    data() {
        return {
            page: {
                showReadspeakerButton: false
            }
        };
    },
    mounted() {
        var scroll = new SmoothScroll('.sidebar-menu a[href*="#"]', {
            header: 'mobile-heading'
        });
        var indexScroll = new SmoothScroll('.index-container a[href*="#"]', {
            offset: 100
        });
        $('[data-toggle="tooltip"]').tooltip();
        this.bindGAEvents();
    },
    methods: {
        moment: moment,
        toggleReadspeaker() {
            this.page.showReadspeakerButton = !this.page.showReadspeakerButton;
            if (this.page.showReadspeakerButton) {
                var $playBtn = $(this.$refs.readspeakerButton)
                    .find('.rsplay')
                    .first();
                $playBtn.trigger('click');
            } else {
                var $stopBtn = $(this.$refs.readspeakerButton)
                    .find('.rsbtn_stop')
                    .first();
                $stopBtn.trigger('click');
            }
        },
        bindGAEvents(){
            if(typeof ga !== "undefined"){
                $('body').on('mousedown', '[data-ga-te-category]', function(e){
                    var elem = $(this),
                        category = elem.data('ga-te-category')||'',
                        action = elem.data('ga-te-action')||'',
                        label = elem.data('ga-te-label')||'',
                        value = elem.data('ga-te-value');
                    if(label){
                        ga('send', 'event' ,category, action, label, value);
                    } else { 
                        ga('send', 'event' ,category, action, ''+value+'');
                    }
                });
            }
        }
    }
});

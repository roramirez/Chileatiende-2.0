import './bootstrap';

import PageForm from './components/PageForm.vue';
import PageMasterForm from './components/PageMasterForm.vue';
import PageStatusForm from './components/PageStatusForm.vue';
import PagesOrderForm from './components/PagesOrderForm.vue';
import OfficeForm from './components/OfficeForm.vue';
import MinistryForm from './components/MinistryForm.vue';
import InstitutionForm from './components/InstitutionForm.vue';
import CategoryForm from './components/CategoryForm.vue';
import UserForm from './components/UserForm.vue';
import ProfileForm from './components/ProfileForm.vue';
import OfficesCollapse from './components/OfficesCollapse.vue';
import MobileMenu from './components/MobileMenu.vue';
import PageFilterForm from './components/PageFilterForm.vue';
import AccessTokenForm from './components/AccessTokenForm.vue';
import NotificationForm from './components/NotificationForm.vue';
import PastUsers from './components/PastUsers.vue';
import ContentForm from './components/ContentForm.vue';
import Steps from './components/Steps.vue';
import Messages from './components/Messages.vue';

import Confirm from './directives/Confirm.js';

Vue.prototype.$eventHub = new Vue();

new Vue({
    el: '#app',
    components: {
        PageForm,
        PageMasterForm,
        PageStatusForm,
        PagesOrderForm,
        OfficesCollapse,
        MobileMenu,
        UserForm,
        ProfileForm,
        OfficeForm,
        MinistryForm,
        InstitutionForm,
        CategoryForm,
        PageFilterForm,
        AccessTokenForm,
        NotificationForm,
        PastUsers,
        ContentForm,
        Steps,
        Messages
    },
    directives:{
        Confirm
    },
    methods:{
        moment: moment,
        showMessages (e, pageId) {
            e.preventDefault();
            this.$eventHub.$emit('show-messages', pageId);
        }
    },
    mounted() {
        $('[data-toggle="tooltip"]').tooltip();
    }
});

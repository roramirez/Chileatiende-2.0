/* globals $ */
const resizableElements = [
    '.breadcrumb',
    '#page-content p',
    '#page-content ul',
    '#page-content ol',
    '#page-content h3',
    '#page-content h4',
    '#page-content .nav-tabs a',
    '#page-content .online',
    '#page-content .author',
    '#page-content .message',
    '#page-content .updated-at',
    '#page-content .accessibility-bar',
    '.sidebar-menu ol',
    '.sidebar-menu ol a',
    '.btn-online'
];

export default {
    data() {
        return {
            resizableElements: []
        };
    },
    mounted() {
        this.resizablesElementsFonts = $(resizableElements.join(', '));
    },
    methods: {
        resizePageFontSize(increase) {
            let multipier = 3;
            this.resizablesElementsFonts.each((index, element) => {
                let fontSize = parseInt(window.getComputedStyle(element, null).getPropertyValue('font-size'));
                fontSize = (fontSize + (multipier * (increase ? 1 : -1))) + 'px';
                element.style.fontSize = fontSize;
            });
        }
    }
};

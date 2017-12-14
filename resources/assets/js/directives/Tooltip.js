var tippy = require('tippy.js');
require('tippy.js/dist/tippy.css');

module.exports = {
    bind: function(el, binding){

        el.tooltip = tippy(el,{
            dynamicTitle: true
        });

    },

    unbind: function(el){
        el.tooltip.destroyAll();
    }
}
module.exports = {
    bind: function(el, binding){

        el.addEventListener('click', function(event){
            console.log('a');
            const confirm = window.confirm('¿Está seguro que desea realizar esta acción? Esta acción es irreversible.');

            if(!confirm)
                event.preventDefault();

        });

    },

    unbind: function(el){
        el.tooltip.destroyAll();
    }
};
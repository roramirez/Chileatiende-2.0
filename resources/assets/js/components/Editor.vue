<template>
    <textarea ref="textarea">{{value}}</textarea>
</template>

<script>
    var tinymce = require('tinymce');
    require('tinymce/plugins/code/index.js');
    require('tinymce/themes/modern/theme');
    require('tinymce/skins/lightgray/skin.min.css');
    require('tinymce/skins/lightgray/content.min.css');

    export default {
        props: ['value'],
        mounted: function(){
            var self = this;

            tinymce.init({
                target: this.$refs.textarea,
                height: 300,
                skin: false,
                entity_encoding : "raw",
                plugins: 'code',
                content_style: '.message{border: 1px solid #ccc; padding: 5px;} .message-alerta:before{content:"[Alerta] "} .message-reloj:before{content:"[Reloj] "}',
                style_formats: [
                    { title: 'Alerta', block:'div' ,classes: 'message message-alerta' },
                    { title: 'Reloj', block:'div' ,classes: 'message message-reloj' },
                ],
                setup: function (editor) {
                    editor.on('change', function () {
                        self.$emit('input', editor.getContent());
                    });
                }
            });
        }
    }
</script>
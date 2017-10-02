<template>
    <textarea ref="textarea">{{value}}</textarea>
</template>

<script>
    var tinymce = require('tinymce');
    require('tinymce/plugins/code/plugin.js');
    require('tinymce/plugins/media/plugin.js');
    require('tinymce/plugins/image/plugin.js');
    require('tinymce/themes/modern/theme');
    require('tinymce/skins/lightgray/skin.min.css');

    export default {
        props: ['value'],
        mounted: function(){
            var self = this;

            tinymce.init({
                target: this.$refs.textarea,
                height: 300,
                skin: false,
                entity_encoding : "raw",
                plugins: 'code image media',
                toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | code image media',
                content_css: '/css/tinymce.css',
                document_base_url : "http://localhost:3000/",
                images_upload_url: 'backend/api/files',
                images_upload_handler: function(blobInfo, success, failure){
                    let data = new FormData();
                    data.append('file', blobInfo.blob());

                    axios.post('backend/api/files', data)
                        .then(function(response){
                            success(response.data);
                        })
                        .catch(function(error){
                            failure(error.response.data);
                        });
                },
                style_formats: [
                    { title: 'Alerta', block:'div' ,classes: 'message message-alerta' },
                    { title: 'Reloj', block:'div' ,classes: 'message message-reloj' },
                    { title: 'Doc', block:'div' ,classes: 'doc doc-doc' },
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
<template>
    <textarea ref="textarea">{{value}}</textarea>
</template>

<script>
    var tinymce = require('tinymce');
    require('tinymce/plugins/code/plugin.js');
    require('tinymce/plugins/media/plugin.js');
    require('tinymce/plugins/image/plugin.js');
    require('tinymce/plugins/table/plugin.js');
    require('tinymce/plugins/lists/plugin.js');
    require('tinymce/plugins/link/plugin.js');
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
                plugins: 'code image media table lists link',
                toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | code image media | link unlink table',
                content_css: '/css/app.css',
                content_style: "body{background: white; color: #272727; padding: 20px;}",
                body_id: 'page',
                table_default_attributes: {
                    class: 'table table-bordered'
                },
                table_class_list: [
                    {title: 'Bordered', value: 'table table-bordered'},
                    {title: 'Striped', value: 'table table-bordered'},
                    {title: 'Fechas', value: 'table table-dates'},
                ],
                document_base_url : window.baseUrl,
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
                    { title: 'Moneda', inline:'span' ,classes: 'highlight highlight-green' },
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
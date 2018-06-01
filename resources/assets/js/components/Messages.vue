<template>
    <Modal :show="isModalVisible"  @close="closeMessages">
        <div class="messages">
            <div class="messages-header">
                <i class="material-icons">message</i>
                <span class="page-title">
                    ID {{page.id}} - {{page.title}}
                </span>
            </div>
            <div class="messages-body">
                <div class="message" v-for="message in page.messages">
                    <div class="user-photo">
                        <img :src="`https://ui-avatars.com/api/?name=${message.user.first_name}+${message.user.last_name}`" />
                    </div>
                    <div class="message-body">
                        <div class="user-name">
                            {{message.user.first_name}} {{message.user.last_name}}
                            <div class="message-time">
                                {{message.created_at | ago }}
                            </div>
                        </div>
                        <div class="message-text">
                            {{message.text}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="messages-footer">
                <div class="input-group">
                    <input type="text" v-model="text" class="form-control"/>
                    <div class="input-group-btn">
                        <button class="btn btn-primary" type="button" @click="storeMessage">Enviar</button>
                    </div>
                </div>
            </div>
        </div>
    </Modal>
</template>
<style lang="scss">

    .messages {

        .messages-header {
            background-color: #147AB2;
            color: #FFFFFF;
            padding: 10px 20px 4px 20px;

            .page-title {
                padding-left: 20px;
                vertical-align: top;
                line-height: 26px;
            }
        }

        .messages-body {

            .message {
                margin: 20px;
                padding-bottom: 30px;
                border-bottom: 1px solid #E0E0E0;

                .user-photo {
                    float: left;

                    width: 96px;
                    img {
                        border-radius: 50%;
                    }
                }

                .message-body {
                    width: calc(100%);
                    padding-left: 96px;

                    .message-text {
                        margin-top: 10px;
                    }

                    .message-time {
                        float: right;
                    }

                    .user-name {
                        font-weight: bold;
                    }

                }

                
                &.me {
                    .user-photo {
                        float: right;
                        text-align: right;
                    }

                    .message-body {
                        padding-left: 0;
                        padding-right: 96px;

                        .message-time {
                            float: left;
                        }

                        .user-name {
                            text-align: right;
                        }

                    }
                }
            }

        }

        .messages-footer {
            padding: 20px;
            background-color: #F4F6F7;
        }
    }

</style>
<script>

    import Modal from './Modal.vue';

    export default {
        components: {
            Modal
        },
        data () {
            return {
                isModalVisible: false,
                id: null,
                page: {},
                text: ''
            };
        },
        created () {
          this.$eventHub.$on('show-messages', (pageId) => {
              this.openMessages(pageId);
          })
        },
        beforeDestroy () {
            this.$eventHub.$off('show-messages');
        },
        filters: {
            ago(date) {
                return moment(date, 'YYYY-MM-DD HH:mm:ss').fromNow();
            }
        },
        methods: {
            openMessages (pageId) {
                this.isModalVisible = true;
                this.id = pageId;
                this.findPage();
            },
            closeMessages () {
                this.isModalVisible = false;
                this.id = null;
            },
            findPage () {
                axios({
                    url: `backend/api/pages/${this.id}/messages`,
                    method: 'GET'
                }).then(response => {
                    this.page= response.data;
                }).catch(error => {
                    this.errors = error.response.data.errors;
                });
            },
            storeMessage () {
                axios({
                    url: `backend/api/pages/${this.id}/messages`,
                    method: 'POST',
                    data: {
                        text: this.text
                    }
                })
                    .then(response => {
                        this.page.messages.push(response.data);
                        this.text = '';
                    })
                    .catch(error => {
                        this.errors = error.response.data.errors;
                    });
            }
        }
    }

</script>
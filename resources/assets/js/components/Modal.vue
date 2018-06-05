<template>
    <div>
        <transition-group name="modal">
            <div v-show="show" :key="1" class="modal-overlay" @click="close">
                <div class="modal-container" @click.stop>
                    <slot></slot>
                </div>

            </div>
            <div v-show="show" :key="2" class="optional-modal-overlay" @click="close"></div>
        </transition-group>

    </div>
</template>

<style lang="scss">
    .modal-limit {
        position: relative;

        .optional-modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 9997;
            background-color: rgba(0, 0, 0, .5);
            transition: opacity .3s ease;
            display: block;
        }

        .modal-overlay {
            position: absolute;
            background-color: transparent;

            .modal-container {
                width: 100%;
                margin: 60px auto 0;
                padding: 0;
            }
        }
    }

    .optional-modal-overlay {
        display: none;
    }

    .modal-overlay {
        position: fixed;
        z-index: 9998;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, .5);
        transition: opacity .3s ease;

        .modal-container {
            width: 300px;
            margin: 40px auto 0;
            padding: 20px 30px;
            background-color: #fff;
            border-radius: 2px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, .33);
            transition: all .3s ease;
        }
    }

    .modal-enter {
        opacity: 0;
    }

    .modal-leave-active {
        opacity: 0;
    }

    .modal-enter .modal-container,
    .modal-leave-active .modal-container {
        -webkit-transform: scale(1.1);
        transform: scale(1.1);
    }
</style>

<script>

    export default {
        props: ['show'],
        methods: {
            close () {
                this.$emit('close');
            }
        },
        mounted () {
            document.addEventListener('keydown', e => {
                if (this.show && e.code === 'Escape') {
                    this.close();
                }
            });
        }
    }

</script>
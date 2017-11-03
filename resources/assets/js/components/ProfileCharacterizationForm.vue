<template>
    <form class="profile-characterization-form" @submit.prevent="submit()">

        <div class="row">
            <div class="col-sm-6">
                <h3>Ayúdanos para entregarte mejor información</h3>
            </div>
            <div class="col-sm-6">
                <div class="text-right">Paso {{step}} de {{maxSteps}}</div>
            </div>
        </div>

        <hr />

        <p>Mi ChileAtiende te permite acceder de manera personalizada a información de trámites y servicios publicados en el Portal ChileAtiende y acceder a notificaciones del Estado.</p>
        <p>Para obtener información de acuerdo a tus intereses, por favor completa lo siguientes datos:</p>

        <br />


        <fieldset v-if="step == 1">
            <div class="row">
                <div class="col-sm-offset-4 col-sm-4">
                    <ol>
                        <li>
                            <div class="form-group" :class="{'has-error': errors['birth_date']}">
                                <label for="birth_date" class="control-label">Fecha de Nacimiento</label>
                                <el-date-picker id="birth_date" v-model="data.birth_date" format="dd/MM/yyyy" placeholder="Día/Mes/Año"></el-date-picker>
                                <div class="help-block" v-for="e in errors['birth_date']">{{e}}</div>
                            </div>
                        </li>
                        <li>
                            <div class="form-group" :class="{'has-error': errors['gender']}">
                                <label class="control-label">Sexo</label>
                                <div>
                                    <label class="radio-inline">
                                        <input type="radio" v-model="data.gender" value="m"> Masculino
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" v-model="data.gender" value="f"> Femenino
                                    </label>
                                </div>
                                <div class="help-block" v-for="e in errors['gender']">{{e}}</div>
                            </div>
                        </li>
                        <li>
                            <div class="form-group" :class="{'has-error': errors['nationality']}">
                                <label for="nationality" class="control-label">Nacionalidad</label>
                                <el-select id="nationality" v-model="data.nationality" filterable>
                                    <el-option v-for="c in countries" :value="c.alpha3Code" :key="c.alpha3Code" :label="c.name"></el-option>
                                </el-select>
                                <div class="help-block" v-for="e in errors['nationality']">{{e}}</div>
                            </div>
                        </li>
                        <li>
                            <div class="form-group" :class="{'has-error': errors['foreigner']}">
                                <label class="control-label">¿Actualmente vive en Chile?</label>
                                <div>
                                    <label class="radio-inline">
                                        <input type="radio" v-model="data.foreigner" :value="false"> Si
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" v-model="data.foreigner" :value="true"> No
                                    </label>
                                </div>
                                <div class="help-block" v-for="e in errors['foreigner']">{{e}}</div>
                            </div>
                        </li>
                        <li>
                            <div class="form-group" :class="{'has-error': errors['rsh']}">
                                <label for="rsh" class="control-label">Puntaje Registro Social de Hogares</label>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <input class="form-control" id="rsh" v-model="data.rsh" type="number" placeholder="Puntaje"></input>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="help-block text-center"><a href="#">¿Cómo obtengo mi puntaje?</a></div>
                                    </div>
                                </div>

                                <div class="help-block" v-for="e in errors['rsh']">{{e}}</div>
                            </div>
                        </li>
                    </ol>
                </div>
            </div>
        </fieldset>
        <fieldset v-if="step == 2">
            <label>Indicanos cuales son tus temas de interes</label>

            <div class="row">
                <div v-for="c in categories" class="col-sm-4">
                    <div class="checkbox"><label><input type="checkbox" /> {{c.name}}</label></div>
                </div>
            </div>

        </fieldset>

        <div class="row">
            <div class="col-sm-offset-4 col-sm-4">
                <div class="form-group">
                    <button class="btn btn-block" @click="step = step-1" v-show="step > 1" type="button"><- Paso Anterior</button>
                    <button class="btn btn-block" @click="step = step+1" v-show="step < maxSteps" type="button">Siguiente Paso -></button>
                    <button class="btn btn-block btn-primary" type="submit" v-show="step == maxSteps">Enviar Formulario</button>
                </div>
            </div>
        </div>



    </form>


</template>
<style lang="scss" scoped>
    .profile-characterization-form{
        fieldset{
            >ol{
                padding-left: 0;
            }
            .form-group{
                .el-input{
                    display: block;
                    &.el-date-editor{
                        width: auto;
                    }
                }
                .el-select{
                    display: block;
                }
            }

        }
    }
</style>
<script>
    import ElDatePicker from 'element-ui/lib/date-picker';
    import ElSelect from 'element-ui/lib/select';
    import ElOption from 'element-ui/lib/option';

    export default {
        data: function(){
            var data = _.cloneDeep(this.user);

            return{
                data: data,
                errors: {},
                categories: [],
                countries: [],
                maxSteps: 2,
                step: 1
            }
        },
        props: ['user'],
        components:{
            ElDatePicker,
            ElSelect,
            ElOption
        },
        methods:{
            submit: function(){
                var self = this;

                axios({
                    url: 'perfil',
                    method: 'PUT',
                    data: self.data,
                }).then(function(response){
                    window.location.replace(response.data.redirect);
                }).catch(function(error){
                    self.errors = error.response.data.errors;
                });
            }
        },
        mounted: function(){
            var self = this;

            axios.get('api/categories')
                .then(function(response){
                    self.categories = response.data;
                });

            $.getJSON('https://restcountries.eu/rest/v2/all?fields=name;alpha3Code',function(response){
                self.countries = response;
            });


        }
    }
</script>
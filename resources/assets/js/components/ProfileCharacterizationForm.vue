<template>
    <form class="profile-characterization-form" @submit.prevent>

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


        <fieldset v-show="step == 1">
            <div class="row">
                <div class="col-sm-offset-3 col-sm-6">
                    <ol>
                        <li>
                            <div class="form-group" :class="{'has-error': errors['email'], active: subStep == 1}" @click="subStep = 1">
                                <label for="email" class="control-label">Correo Electrónico</label>
                                <input type="email" id="email" class="form-control" v-model="data.email">
                                <div class="help-block" v-for="e in errors['email']">{{e}}</div>
                            </div>
                        </li>
                        <li>
                            <div class="form-group" :class="{'has-error': errors['phone'], active: subStep == 2}" @click="subStep = 2">
                                <label for="phone" class="control-label">Teléfono Movil (Opcional)</label>
                                <input type="phone" id="phone" class="form-control" v-model="data.phone">
                                <div class="help-block" v-for="e in errors['phone']">{{e}}</div>
                            </div>
                        </li>
                        <li>
                            <div class="form-group" :class="{'has-error': errors['birth_date'], active: subStep == 3}" @click="subStep = 3">
                                <label for="birth_date" class="control-label">Fecha de Nacimiento</label>
                                <el-date-picker id="birth_date" v-model="data.birth_date" format="dd/MM/yyyy" placeholder="Día/Mes/Año" @change="subStep++"></el-date-picker>
                                <div class="help-block" v-for="e in errors['birth_date']">{{e}}</div>
                            </div>
                        </li>
                        <li>
                            <div class="form-group" :class="{'has-error': errors['gender'], active: subStep == 4}" @click="subStep = 4">
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
                            <div class="form-group" :class="{'has-error': errors['nationality'], active: subStep == 5}" @click="subStep = 5">
                                <label for="nationality" class="control-label">Nacionalidad</label>
                                <el-select id="nationality" v-model="data.nationality" filterable @change="subStep++">
                                    <el-option v-for="c in countries" :value="c.alpha3Code" :key="c.alpha3Code" :label="c.name"></el-option>
                                </el-select>
                                <div class="help-block" v-for="e in errors['nationality']">{{e}}</div>
                            </div>
                        </li>
                        <li>
                            <div class="form-group" :class="{'has-error': errors['foreigner'], active: subStep == 6}" @click="subStep = 6">
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
                    </ol>
                </div>
                <div class="col-sm-3">
                    <div class="step-buttons">
                        <div>
                            <button class="btn" @click="subStep--" type="button" :disabled="subStep == 1">▲</button>
                        </div>
                        <br/>
                        <div>
                            <button class="btn" @click="subStep++" type="button"  :disabled="subStep == maxSubSteps">▼</button>
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>
        <fieldset v-show="step == 2">
            <div class="categories">
                <label class="control-label">Indicanos cuales son tus temas de interes</label>

                <el-checkbox-group v-model="data.categories">
                    <div class="row">
                        <div v-for="c in categories" class="col-sm-4">
                            <el-checkbox :label="c.id">{{c.name}}</el-checkbox>
                        </div>
                    </div>
                </el-checkbox-group>
            </div>

        </fieldset>

        <div class="row">
            <div class="col-sm-offset-3 col-sm-6">
                <div class="form-group">
                    <button class="btn btn-block btn-link" @click="step = step-1" v-show="step > 1" type="button">← Paso Anterior</button>
                    <button class="btn btn-block btn-primary" @click="step = step+1" v-show="step < maxSteps" type="button">Siguiente Paso →</button>
                    <button class="btn btn-block btn-primary" type="button" v-show="step == maxSteps" @click="submit">Enviar Formulario</button>
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
                opacity: 0.2;
                &.active{
                    opacity: 1;
                }
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
        .step-buttons{
            text-align: center;
            margin-top: 200px;
        }
    }
</style>
<script>
    import ElDatePicker from 'element-ui/lib/date-picker';
    import ElSelect from 'element-ui/lib/select';
    import ElOption from 'element-ui/lib/option';
    import ElCheckboxGroup from 'element-ui/lib/checkbox-group';
    import ElCheckbox from 'element-ui/lib/checkbox';

    export default {
        data: function(){
            var data = _.cloneDeep(this.user);

            return{
                data: data,
                errors: {},
                categories: [],
                countries: [],
                maxSteps: 2,
                step: 1,
                subStep: 1,
                maxSubSteps: 6
            }
        },
        props: ['user'],
        components:{
            ElDatePicker,
            ElSelect,
            ElOption,
            ElCheckboxGroup,
            ElCheckbox
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
                    self.step = 1;
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
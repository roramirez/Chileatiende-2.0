<template>
    <form @submit.prevent="submit">
        <div class="text-right">
            <button class="btn btn-primary" type="submit">Guardar</button>
        </div>
        <table class="table">
            <thead>
            <tr>
                <th>Id</th>
                <th>Nombre del trámite</th>
                <th>Publicado</th>
                <th>Última modificación</th>
                <th>Orden</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(p,index) in data">
                <td>{{p.id}}</td>
                <td>{{p.title}}</td>
                <td class="text-center">
                    <i v-if="p.published" class="material-icons" data-toggle="tooltip" title="Publicado">check</i>
                </td>
                <td>{{p.updated_at}}</td>
                <td>
                    <a href="#" @click.prevent="up(index)"><i class="material-icons">arrow_upward</i></a>
                    <a href="#" @click.prevent="down(index)"><i class="material-icons">arrow_downward</i></a>
                </td>
            </tr>
            </tbody>
        </table>
        <div class="text-right">
            <button class="btn btn-primary" type="submit">Guardar</button>
        </div>
    </form>
</template>
<script>
    export default{
        data: function(){
            return {
                data: _.cloneDeep(this.pages),
                errors: {}
            }
        },
        props: ['pages'],
        methods:{
            up: function(from){
                if(from == 0)
                    return;

                var to = from - 1;
                this.data.splice(to, 0, this.data.splice(from, 1)[0]);
            },
            down: function(from){
                var to = from + 1;
                this.data.splice(to, 0, this.data.splice(from, 1)[0]);
            },
            submit: function(){
                var self = this;

                var output = {
                    pages: this.data.map(function(d, index){
                        return {
                            id: d.id,
                            order: index
                        }
                    })
                };

                axios.put('backend/fichas/featured',output)
                    .then(function(response){
                        window.location.replace(response.data.redirect);
                    }).catch(function(error){
                        self.errors = error.response.data.errors;
                });
            }
        }
    }
</script>
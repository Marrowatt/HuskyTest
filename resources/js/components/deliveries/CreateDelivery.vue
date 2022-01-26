<template>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Criando uma entrega</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="container-fluid">
                <div class="col-12 mx-auto">

                    <label for="client" class="mt-3"> Cliente: </label>
                    <multiselect v-model="delivery.client_id" :options="clients" placeholder="Selecione: " label="name" track-by="name"></multiselect>
                    
                    <label for="deliver" class="mt-3"> Entregador: </label>
                    <multiselect v-model="delivery.deliver_id" :options="delivers" placeholder="Selecione: " label="name" track-by="name"></multiselect>

                    <label for="collect_point" class="mt-3"> Ponto de Recolha: </label>
                    <div class="row">
                        <div class="col-4 mb-2">
                            <input type="text" class="form-control" v-model="collect_point.zipcode" name="zipcode" placeholder="CEP:">
                        </div>
                        <div class="col-8 mb-2">
                            <input type="text" class="form-control" v-model="collect_point.street" name="street" placeholder="Rua:">
                        </div>
                       
                        <div class="col-3 mb-2">
                            <input type="text" class="form-control" v-model="collect_point.number" name="number" placeholder="Número:">
                        </div>
                        <div class="col-5 mb-2">
                            <input type="text" class="form-control" v-model="collect_point.neighborhood" name="neighborhood" placeholder="Bairro:">
                        </div>
                        <div class="col-4 mb-2">
                            <input type="text" class="form-control" v-model="collect_point.complement" name="complement" placeholder="Complemento:">
                        </div>
                        
                        <div class="col-6 mb-2">
                            <input type="text" class="form-control" v-model="collect_point.city" name="city" placeholder="Cidade:">
                        </div>
                        <div class="col-6 mb-2">
                            <input type="text" class="form-control" v-model="collect_point.state" name="state" placeholder="Estado:">
                        </div>
                    </div>
                    
                    
                    <label for="destination_point" class="mt-3"> Ponto de Destino: </label>
                    <div class="row">
                        <div class="col-4 mb-2">
                            <input type="text" class="form-control" v-model="destination_point.zipcode" name="zipcode" placeholder="CEP:">
                        </div>
                        <div class="col-8 mb-2">
                            <input type="text" class="form-control" v-model="destination_point.street" name="street" placeholder="Rua:">
                        </div>
                       
                        <div class="col-3 mb-2">
                            <input type="text" class="form-control" v-model="destination_point.number" name="number" placeholder="Número:">
                        </div>
                        <div class="col-5 mb-2">
                            <input type="text" class="form-control" v-model="destination_point.neighborhood" name="neighborhood" placeholder="Bairro:">
                        </div>
                        <div class="col-4 mb-2">
                            <input type="text" class="form-control" v-model="destination_point.complement" name="complement" placeholder="Complemento:">
                        </div>
                        
                        <div class="col-6 mb-2">
                            <input type="text" class="form-control" v-model="destination_point.city" name="city" placeholder="Cidade:">
                        </div>
                        <div class="col-6 mb-2">
                            <input type="text" class="form-control" v-model="destination_point.state" name="state" placeholder="Estado:">
                        </div>
                    </div>
                    
                    <button class="btn col-12 mx-auto btn-primary mt-4 mb-3" data-bs-dismiss="modal" aria-label="Fechar" @click="sendToUp">Enviar</button>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
    export default {
        props: {
            delivers: Array,
        },
        data () {
            return {
                clients: [],
                delivery: {},
                collect_point: {},
                destination_point: {},
            }
        },
        mounted () {
            this.getClients();
        },
        methods: {
            getClients () {
                axios.get('/getClients').then(resp => {
                    resp.data.forEach(el => {
                        this.clients.push({id: el.id, name: el.name});
                    });
                });
            },
            sendToUp () {
                
                this.delivery.client_id = this.delivery.client_id.id;

                if(this.delivery.deliver_id) {
                    this.delivery.deliver_id = this.delivery.deliver_id.id;
                }
                
                this.delivery.collect_point = this.collect_point;
                this.delivery.destination_point = this.destination_point;

                this.$emit('creating', { delivery: this.delivery });
            },
        },
        computed: {
            
        },
        watch: {

        }
    }
</script>
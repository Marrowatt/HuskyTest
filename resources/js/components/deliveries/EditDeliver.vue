<template>
<div class="modal fade" id="editDeliver" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Atribuindo um entregador</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="container-fluid">
                <div class="col-12 mx-auto" v-if="load"> Aguarde... </div>
                <div class="col-12 mx-auto" v-else>

                    <label for="client" class="mt-3"> Entregador: </label>
                    <multiselect v-model="delivery.deliver_id" :options="delivers" placeholder="Selecione: " label="name" track-by="name"></multiselect>
                    
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
            delivery: Object,
            delivers: Array,
        },
        data () {
            return {
                load: true,

            }
        },
        mounted () {
        },
        methods: {
            sendToUp () {
                
                this.delivery.deliver_id = this.delivery.deliver_id.id;

                this.$emit('delivering', { delivery: this.delivery });
            },
        },
        computed: {
            
        },
        watch: {
            delivery (val) {
                this.load = false;
            }
        }
    }
</script>
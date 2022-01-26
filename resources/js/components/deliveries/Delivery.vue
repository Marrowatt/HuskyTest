<template>
    <div class="container">
        <div class="row">
        <div class="col-md-12"> 
            <div class="card">
                <div class="card-header">
                    <h5 class="title-page">Entregas</h5>
                </div>
                <div class="card-body">
                    <div v-if="errors">
                        <ul v-for="(err, ind) in errors" :key="ind">
                            <ul v-for="(e, i) in err" :key="i">
                                <p class="form-control bg bg-primary text-center"> {{ e }} </p>
                            </ul>
                        </ul>
                    </div>
                    <div v-if="msg != '' && msg != null" >
                        <h5 class="form-control text-center bg bg-info" v-html="msg"></h5>
                    </div>

                    <div class="row">
                        <div class="col-3">
                            <label for="status">Status</label>
                            <multiselect v-model="params.status" :options="status" :multiple="true" :taggable="true" placeholder="Selecione: " track-by="name" label="name"></multiselect>
                        </div>
                        <div class="col-3">
                            <label for="deliver">Entregador</label>
                            <multiselect v-model="params.deliver" :options="delivers" :multiple="true" :taggable="true" placeholder="Selecione: " track-by="name" label="name"></multiselect>
                        </div>
                        <div class="col-3 offset-3 text-right">
                            <button class="btn btn-success btn-lg" data-bs-toggle="modal" data-bs-target="#exampleModal">Criar Entrega</button>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="text-center text-info mx-auto" v-if="loading"> Aguarde, estamos pensando... </div>
                        <div v-else class="table-responsive col-md-12">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <th> Cliente </th>
                                    <th> Entregador </th>
                                    <th> Ponto de Colega </th>
                                    <th> Ponto de Entrega </th>
                                    <th> Status </th>
                                    <th class="text-center text-secondary"> Ações </th>
                                </thead>

                                <tbody>
                                    <tr v-for="(d, index) in pageOfItems" :key="index">
                                        <td> {{ d.client }} </td>
                                        <td> {{ d.deliver }} </td>
                                        <td> {{ d.collect }} </td>
                                        <td> {{ d.destination }} </td>
                                        <td> {{ d.status }} </td> 
                                        <td> <button class="btn btn-warning m-1 rounded" data-bs-toggle="modal" data-bs-target="#editModal" @click="deli = d"> Editar </button>
                                             <button class="btn btn-primary m-1 rounded" data-bs-toggle="modal" data-bs-target="#editStatus" @click="deli = d"> Alterar Status </button>
                                             <button class="btn btn-dark m-1 rounded text-light" data-bs-toggle="modal" data-bs-target="#editDeliver" @click="deli = d"> Atribuir Enregadores </button> </td>
                                    </tr>
                                </tbody>
                            </table>
                            
                        </div>
                        
                        <createdelivery @creating="create" :delivers="delivers"></createdelivery>
                        <editdelivery :delivery="deli" @updating="update" :delivers="delivers"></editdelivery>
                        <editstatus :delivery="deli" @statusing="statused" :status="status"></editstatus>
                        <editdeliver :delivery="deli" @delivering="delivered" :delivers="delivers"></editdeliver>

                        <div class="mx-auto pb-0 pt-3">
                            <jw-pagination :items="searchDeliveries" @changePage="onChangePage"></jw-pagination>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>

    export default {
        data () {
            return {
                deli: {},
                deliveries: [],
                params: {
                    deliver: [],
                    status: [],
                },
                loading: true,
                pageOfItems: [],
                errors: null,
                msg: null,
                status: [],
                delivers: [],
            }
        },
        mounted () {
            this.getDeliveries();
            this.getStatus();
            this.getDelivers();
        },
        methods: {
            onChangePage (pageOfItems) {
                this.pageOfItems = pageOfItems;
            },
            getStatus () {
                axios.get('/getStatus').then(resp => {
                    resp.data.forEach(el => {
                        this.status.push({id: el.id, name: el.name});
                    });
                });
            },
            getDelivers () {
                axios.get('/getDelivers').then(resp => {
                    resp.data.forEach(el => {
                        this.delivers.push({id: el.id, name: el.name});
                    });
                });
            },
            getDeliveries () {
                axios.get('/getDeliveries').then(data => {
                    this.deliveries = data.data;
                    this.loading = false;
                });
            },
            nullify () {
                this.msg = null;
                this.errors = null;
            },
            search (deliveries, params) {
                
                var filtered = [];

                deliveries.forEach(el => {
                    
                    if(params.status.find( em => el.status == em.name ) == undefined && params.status.length > 0) return;
                    
                    if(params.deliver.find( em => el.deliver == em.name ) == undefined && params.deliver.length > 0) return;
                    
                    filtered.push(el);
                });
                
                return filtered;
            },
            create (payload) {
                this.nullify();
                axios.post('/storeDelivery', payload.delivery).then(data => {
                    this.msg = "Entrega criada!";
                    this.getDeliveries();
                }).catch(error => {
                    if (error.response.status == 422) this.errors = error.response.data;
                    if (error.response.status == 500) this.errors = {Erro: {message: "Erro! Tente novamente mais tarde."}};
                    this.getDeliveries();
                });
            },
            update (payload) {
                this.nullify();
                axios.put('/updateDelivery/' + payload.delivery.id, payload.delivery).then(data => {
                    this.msg = "Entrega atualizada!";
                    this.getDeliveries();
                }).catch(error => {
                    if (error.response.status == 422) this.errors = error.response.data;
                    if (error.response.status == 500) this.errors = {Erro: {message: "Erro! Tente novamente mais tarde."}};
                    this.getDeliveries();
                });
            },
            statused (payload) {
                this.nullify();
                axios.put('/updateStatusDelivery/' + payload.delivery.id, payload.delivery).then(data => {
                    this.msg = "Status da entrega atualizado!";
                    this.getDeliveries();
                }).catch(error => {
                    if (error.response.status == 422) this.errors = error.response.data;
                    if (error.response.status == 500) this.errors = {Erro: {message: "Erro! Tente novamente mais tarde."}};
                    this.getDeliveries();
                });
            },
            delivered (payload) {
                this.nullify();
                axios.put('/updateDeliverDelivery/' + payload.delivery.id, payload.delivery).then(data => {
                    this.msg = "Entregador atribuído a entrega!";
                    this.getDeliveries();
                }).catch(error => {
                    if (error.response.status == 422) this.errors = error.response.data;
                    if (error.response.status == 500) this.errors = {Erro: {message: "Erro! Tente novamente mais tarde."}};
                    this.getDeliveries();
                });
            },
        },
        computed: {
            searchDeliveries: function () {
                return this.search(this.deliveries, this.params);
            },
        },
        watch: {
            params: {
                deep: true,
                handler () {
                    this.searchDeliveries;
                }
            },
        }
    }
</script>
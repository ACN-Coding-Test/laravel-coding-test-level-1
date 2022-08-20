<template>
    <div class="container">
        <div class="modal" v-show="openDeleteConfirmation" id="DeleteConfirmation" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" 
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="display: block;">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content bg-light">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myCenterModalLabel">Delete confirmation</h4>
                    </div>
                    <div class="modal-body">

                        <div class="text-center">
                            <h5> Confirmation on deleting list {{ event.name }}?</h5>
                        </div>

                        <div class="row">
                            <div class="col text-center p-3">
                                <button type="button" class="btn btn-primary" data-dismiss="modal" @click="(openDeleteConfirmation=!openDeleteConfirmation)"> Cancel </button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal" @click="DeleteInventory(event.id)" data-toggle="modal" data-target="#SuccessFail" > Delete </button>
                            </div>
                        </div>

                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
       </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <h4 class="card-title m-3">Event: {{event.name}}</h4>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <p><i class="mdi mdi-calendar"></i>  <strong>Starts at:</strong> {{event.start_at}}</p> <br>

                            </div>
                            <div class="col">
                                <p><i class="mdi mdi-calendar-remove"></i>  <strong>Ends at:</strong> {{event.end_at}}</p>

                            </div>
                        </div>
                        <div class="row">
                            <button type="button" class="btn btn-danger m-1" style="width:40px" @click="(openDeleteConfirmation=!openDeleteConfirmation)" >
                            <i class="mdi mdi-delete-outline"></i>
                            </button>
                            <router-link :to="{ name: 'edit-event', params:{id:event.id}}">
                            <button type="submit" class="btn btn-primary m-1" style="width:40px">
                            <i class="mdi mdi-clipboard-edit-outline"></i>
                            </button>
                            </router-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'single-event',
    data(){
          return{
            event:{
                type: Object,
            },
            openDeleteConfirmation:false,
          };

    },
    methods:{
        fetchEvent:async function(id){
            await axios.get(`/api/v1/events/${id}`).then((response)=>
            {   
                this.event=response.data.data;
            }).catch(err => console.log(err));

        },
        DeleteInventory:async function(id){
            await axios.delete(`/api/v1/events/${id}`).then((response)=>
            {
                
                this.openDeleteConfirmation=!this.openDeleteConfirmation;
                this.$router.push({name:'list-events'}).catch(()=>{});

            }).catch(err => {console.log(err)});

        },
    },
    created:async function () {
                      //Initial Load
                      await this.fetchEvent(this.$route.params.id);

    },
}
</script>

<style>

</style>
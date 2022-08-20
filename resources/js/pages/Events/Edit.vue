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
                            <p class="text-danger" v-if="unauthenticated">User Unauthenticated to perform action.</p>
                        </div>

                        <div class="row">
                            <div class="col text-center p-3">
                                <button type="button" class="btn btn-primary" data-dismiss="modal" @click="()=>{openDeleteConfirmation=!openDeleteConfirmation; unauthenticated=false;}"> Cancel </button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal" @click="DeleteEvent(event.id)" data-toggle="modal" data-target="#SuccessFail" > Delete </button>
                            </div>
                        </div>

                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
       </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <h4 class="card-title m-3">Edit event: {{event.name}}</h4>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <label for="basic-url">Name</label>
                                <div class="input-group mb-3">
                                <input type="text" class="form-control" v-model="event.name">
                                </div>
                                <label for="basic-url"><i class="mdi mdi-calendar"></i> Starts at:</label>
                                <div class="input-group mb-3">
                                <input type="datetime-local" class="form-control" v-model="event.start_at">
                                </div>
                                <label for="basic-url"><i class="mdi mdi-calendar-remove"></i> Ends at:</label>
                                <div class="input-group mb-3">
                                <input type="datetime-local" class="form-control" v-model="event.end_at">
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <button type="button" class="btn btn-danger m-1" data-toggle="modal" data-target="#DeleteConfirmation" @click="openModal(event)" >
                            <i class="mdi mdi-delete-outline"></i>
                            </button>
                            <button type="submit" class="btn btn-primary m-1" @click="UpdateEvent(event)">
                            <i class="mdi mdi-clipboard-edit-outline"></i> Update
                            </button>
                            <p class="text-danger" v-if="updateUnauthenticated">User Unauthenticated to perform action.</p>
                            <p class="text-success" v-if="successUpdate">Update data successful.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'editevent',
    data(){
          return{
            event:{
                type: Object,
            },
            openDeleteConfirmation:false,
            unauthenticated:false,
            updateUnauthenticated:false,
            successUpdate:false,
          };

    },
    methods:{
        fetchEvent:async function(id){
            await axios.get(`/api/v1/events/${id}`).then((response)=>
            {
                this.event=response.data;

            }).catch(err => console.log(err));

        },
        openModal(data){
            this.event=Object.assign({}, data );
            this.openDeleteConfirmation = !this.openDeleteConfirmation;
        },
        UpdateEvent:async function(event) {
            await axios.patch(`/api/v1/events/${event.id}`,event).then((response)=>
            {
                this.updateUnauthenticated = false;
                this.successUpdate = true;
                this.fetchEvent(this.$route.params.id);

            }).catch(err => {
                console.log(err)
                if(err.response.status == 401){
                    this.updateUnauthenticated = true;
                }
            });


        },
        DeleteEvent:async function(id){
            await axios.delete(`/api/v1/events/${id}`).then((response)=>
            {
                this.openDeleteConfirmation=!this.openDeleteConfirmation;
                this.$router.push({name:'list-events'}).catch(()=>{});
                this.unauthenticated = false;

            }).catch(err => {
                console.log(err)
                if(err.response.status == 401){
                    this.unauthenticated = true;
                }
            });

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
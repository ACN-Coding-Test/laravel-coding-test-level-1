<template>
    <div class="container">
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
                            <button type="button" class="btn btn-danger m-1" style="width:40px" data-toggle="modal" data-target="#DeleteConfirmation" @click="(singleEvent=Object.assign({}, event))" >
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
    name: 'editevent',
    data(){
          return{
            event:{
                type: Object,
            },
          };

    },
    methods:{
        fetchEvent:async function(id){
            await axios.get(`/api/v1/events/${id}`).then((response)=>
            {
                this.event=response.data;

            }).catch(err => console.log(err));

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
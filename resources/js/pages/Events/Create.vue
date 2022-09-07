<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <h4 class="card-title m-3">Create a new event</h4>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <label for="basic-url">Name</label>
                                <div class="input-group mb-3">
                                <input type="text" class="form-control" v-model="form.name">
                                </div>
                                <label for="basic-url"><i class="mdi mdi-calendar"></i> Starts at:</label>
                                <div class="input-group mb-3">
                                <input type="datetime-local" class="form-control" v-model="form.start_at">
                                </div>
                                <label for="basic-url"><i class="mdi mdi-calendar-remove"></i> Ends at:</label>
                                <div class="input-group mb-3">
                                <input type="datetime-local" class="form-control" v-model="form.end_at">
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <p class="text-danger" v-if="FormError">Fill in the form completely</p>
                            <button type="button" class="btn btn-primary m-1"  @click="createEvent()" >
                            Create
                            </button>
                            <router-link :to="{ name:'list-events'}">
                            <button type="submit" class="btn btn-danger m-1" >
                            Cancel
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
    name: 'createevent',
    data(){
            return{
                form:{
                    type: Object,
                    name:'',
                    start_at:new Date(),
                    end_at:new Date()
                },
                FormError:false,
                
            };

    },
    methods:{
        createEvent:async function(){
            if(this.form.name !== '' || this.form.start_at !== '' || this.form.end_at !== ''){
                this.FormError = true;
                return;
            }

            await axios.post('/api/v1/events',data,config).then((response)=>
            {
                this.$router.push({name:'list-events'}).catch(()=>{});

            }).catch(err => console.log(err));

        },
    },
}
</script>

<style>

</style>
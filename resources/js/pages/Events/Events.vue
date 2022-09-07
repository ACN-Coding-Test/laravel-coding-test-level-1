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
                            <h5> Confirmation on deleting list {{ singleEvent.name }}?</h5>
                        </div>

                        <div class="row">
                            <div class="col text-center p-3">
                                <button type="button" class="btn btn-primary" data-dismiss="modal" @click="openDeleteConfirmation=!openDeleteConfirmation"> Cancel </button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal" @click="DeleteInventory(singleEvent.id)" data-toggle="modal" data-target="#SuccessFail" > Delete </button>
                            </div>
                        </div>

                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
       </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">

                    <h4 class="card-title m-3">Events</h4>

                    <div class="card-body">
                    <div class="row">

                        <div class="col-3">
                            Search ID or name:
                            <input class="form-control btn-sm" autocomplete="off" type="text" placeholder="Search.." v-model="searchLive"/>
                        </div>
                        <div class="col-9">
                            <router-link :to="{ name: 'create-event'}">
                            <button type="button" class="btn btn-primary m-1 float-right mt-3" >  Add events </button>
                            </router-link>

                        </div>



                    </div>

                        <p class="pt-2">
                        Showing {{ pagination.page_total }} out of {{ pagination.data_total }}
                        </p>
                        <div class="row">
                        
                            <div class="event-list" v-for="event in events.data" :key="event.id">
                                <div class="d-flex flex-row">
                                <div class="info-container">
                                    <p>
                                    <span class="bold">ID</span>: {{ event.id}} <br>
                                    Name : {{ event.name}} <br>

                                    </p>
                                </div>
                                <div class="name-container">
                                    <p>
                                    <i class="mdi mdi-calendar"></i> Starts at : {{ event.start_at}}  <br>
                                    <i class="mdi mdi-calendar-remove"></i> Ends at: {{ event.end_at }}
                                    </p>
                                </div>
                                <div class="description-container">
                                    <p>
    
                                    </p>
                                </div>
                                <div class="action-container">
                                    <router-link :to="{ name: 'single-event', params:{id:event.id}}">
                                    <button class="btn btn-primary m-1" style="width:90px">
                                        Details
                                    </button>
                                    <br>
                                    </router-link>
                                    <button type="button" class="btn btn-danger m-1" style="width:40px" @click="openModal(event)" >
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

                        <nav class="justify-center">
                        <ul class="pagination">
                            <li :class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#" @click="getEvents(pagination.prev_page_url)">Previous</a></li>
                            <li class="page-item"><a class="page-link text-dark" href="#"> Page {{ pagination.current_page}} of {{ pagination.last_page }}</a></li>
                            <li :class="[{disabled: !pagination.next_page_url}]" class="page-item"><a class="page-link" href="#" @click="getEvents(pagination.next_page_url)">Next</a></li>
                        </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'events',
    data(){
          return{
            Mode:"Add",
            form_submit:'',
            events:{
                type: Object,
            },
            singleEvent:{},
            pagination:{},
            searchLive:null,
            SearchPagination:false,
            openDeleteConfirmation:false,
          };

    },
    watch: {
        searchLive(after, before) {
            this.searchEvent();
        }
    },
    methods:{
        getEvents: function (page_url) {
            let vm = this;
            page_url = page_url || '/api/v1/events';
            if(this.SearchPagination){
                axios.get(page_url,{ params: { keyword: this.searchLive, date: this.searchDate } }).then((response)=>{
                            this.events = response.data;
                            vm.makePagination(response.data);
                        }).catch(err => {});
            }else{
                axios.get(page_url).then((response)=>{
                            this.events = response.data;
                            vm.makePagination(response.data);
                        }).catch(err => {});
            }
        },
        searchEvent: function () {
            this.SearchPagination=true;
            let vm = this;
            axios.get('/api/v1/event-search',{ params: { keyword: this.searchLive, date: this.searchDate } }).then((response)=>{
                            this.events = response.data;
                            vm.makePagination(response.data);
                        }).catch(err => {});
        },
        makePagination(data){
            let pagination = {
                current_page:data.current_page,
                last_page:data.last_page,
                next_page_url:data.next_page_url,
                prev_page_url:data.prev_page_url,
                page_total:data.data.length,
                data_total:data.total
            }
            this.pagination = pagination
        },
        openModal(data){
            this.singleEvent=Object.assign({}, data );
            this.openDeleteConfirmation = !this.openDeleteConfirmation;
        },
        DeleteInventory:async function(id){
            await axios.delete(`/api/v1/events/${id}`).then((response)=>
            {
                this.getEvents();
                this.openDeleteConfirmation=!this.openDeleteConfirmation;

            }).catch(err => {console.log(err)});

        },
    },
    created:async function () {
                      //Initial Load
                      await this.getEvents();

    },
}
</script>

<style>
.overflow-hidden {
  overflow: hidden;
}

.preview {
  display: flex;
  justify-content: center;
  align-items: center;
}

.preview img {
  max-width: 100%;
  max-height: 200px;
}

.event-list{
  width: 100%;
  height: fit-content;
  background-color: #5d4954;
  border: 1px solid #181C25;
  border-radius: 5px;
  margin: 0.075rem;
  transition: all 0.4s ease;
  color:rgb(226,226,226);
}
.event-list:hover{
  background:#745365;
}

.img-container{
  margin: 1.5rem;
}

.img-inventory{
  vertical-align: middle;
  width: 70px;
  height: 70px;
  border-radius: 50%;
}

.info-container{
  width:300px;
  padding-left:20px;
  padding-top:20px;
}

.name-container{
  width:fit-content;
  padding-top:20px;
}
.action-container{
  margin:auto;
  padding-left:10px;
  padding-right:10px;

}

.description-container{
  width:400px;
  padding-top:20px;
}
</style>
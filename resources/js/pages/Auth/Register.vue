<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <h4 class="card-title m-3">Login</h4>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <label for="basic-url">Name</label>
                                <div class="input-group mb-3">
                                <input type="name" class="form-control" v-model="form.name">
                                </div>
                                <label for="basic-url">Email</label>
                                <div class="input-group mb-3">
                                <input type="email" class="form-control" v-model="form.email">
                                </div>
                                <label for="basic-url">Password</label>
                                <div class="input-group mb-3">
                                <input type="password" class="form-control" v-model="form.password">
                                </div>
                                <label for="basic-url">Confirm Password</label>
                                <div class="input-group mb-3">
                                <input type="password" class="form-control" v-model="form.password_confirmation">
                                </div>
                                <p class="text-danger" v-if="passwordMismatch">Confirm password mismatch with Password filled in!</p>
                            </div>
                        </div>
                        <div class="row">
                            <button type="button" class="btn btn-primary m-1" @click="RegisterUser()" >
                            <i class="mdi mdi-clipboard-edit"></i> Register
                            </button>
                            <router-link :to="{ name:'login'}">
                                <button type="button" class="btn btn-secondary m-1" >
                                 Login page
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
import { mapState, mapMutations } from 'vuex';
export default {
    name: 'login',
    data(){
            return{
                form:{
                    name:'',
                    email:'',
                    password:'',
                    password_confirmation:'',
                },
            errors:[],
            passwordMismatch:false,
            };
        },
    computed:{
            ...mapState([
            'user',
            ]),
        },
    methods:{
        RegisterUser(){
            if(this.form.password !== this.form.password_confirmation){
                this.passwordMismatch =true;
                return;
            }
            this.passwordMismatch =false;
            axios.post('/api/register',this.form).then((response)=>{
                this.$store.commit('setUserData', response.data);
                this.$router.push({name: 'home'});
            }).catch((error)=>{
              this.errors=error;
            })
        },
      },
}
</script>

<style>

</style>
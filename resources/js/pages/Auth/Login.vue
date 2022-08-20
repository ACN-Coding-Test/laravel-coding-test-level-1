<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <h4 class="card-title m-3">Login</h4>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <label for="basic-url">Email</label>
                                <div class="input-group mb-3">
                                <input type="email" class="form-control" v-model="form.email">
                                </div>
                                <label for="basic-url">Password</label>
                                <div class="input-group mb-3">
                                <input type="password" class="form-control" v-model="form.password">
                                </div>
                                <p class="text-danger" v-if="showError">{{error}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <button type="button" class="btn btn-primary m-1" @click="LoginUser()" >
                            <i class="mdi mdi-login"></i> Login
                            </button>
                            <router-link :to="{ name:'register'}">
                                <button type="button" class="btn btn-secondary m-1" >
                                <i class="mdi mdi-clipboard-edit"></i> Register
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
                    email:'',
                    password:'',
                    
                },
                error:null,
                showError:false,
            };
        },
    computed:{
            ...mapState([
            'user',
            ]),
        },
    methods:{
        LoginUser(){

                this.$store
                .dispatch('login', {
                email: this.form.email,
                password: this.form.password
                }).then(() => {

                if(this.$route.query.from == '/login' || this.$route.query.from == undefined)
                {
                    this.$router.push({path:'/home'}).catch(()=>{});
                    this.showError=false;
                }else{
                    this.$router.push({path:this.$route.query.from}).catch(()=>{});
                }
                })
                .catch(err => {
                    this.showError=true;
                    this.error = err.response.data.message;
                })

        },

    },
}
</script>

<style>

</style>
import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'

Vue.use(Vuex)

export default new Vuex.Store({
    namespaced: true,
    state: {
        user: null,
      },
    getters:{
        UserDetails: state => state.user,
        isLogged: state => !!state.user,
    },
    mutations:{
        setUserData (state, userData) {
            state.user = userData
            localStorage.setItem('user', JSON.stringify(userData))
            axios.defaults.headers.common.Authorization = `Bearer ${userData.token}`
        },
        clearUserData () {
            localStorage.removeItem('user')
            location.reload()
        },
    },
    actions:{
        login ({ commit }, credentials) {
        
            return axios
              .post('/api/login', credentials)
              .then(({ data }) => {
                
                commit('setUserData', data)
              })
          },
      
          logout ({ commit }) {
              axios.post('/api/logout').then((response)=>{
                  commit('clearUserData')
                  this.$router.push({name: 'home'});
              }).catch((error)=>{
                  this.errors=error;
              })    
          },
    }
})
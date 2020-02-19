import Vue from 'vue'
import Vuex from 'vuex'
import Login from './components/Login'

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        loading:{
            visible:false,
            titulo:'',
            mensaje:'' 
        }
    },
    mutations: {
        mostrarLoading(state, loading){
            state.loading.titulo=loading.titulo
            state.loading.mensaje=loading.mensaje
            state.loading.visible=true
        },
        ocultarLoading(state){
            state.loading.visible=false
        }   
    }
})
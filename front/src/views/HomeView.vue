<<<<<<< HEAD
<template>
    <div class="bg-indigo-500">
        <div class="p-4 flex text-white h-32">
            <h1 class="border border-red-500 ml-10 max-h-max">Bem vindo ao {{ detailHotel.name }}</h1>
        
            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                <path d="M2.535 11A3.981 3.981 0 0 0 2 13v4a1 1 0 0 0 1 1h2v1a1 1 0 1 0 2 0v-1h10v1a1 1 0 1 0 2 0v-1h2a1 1 0 0 0 1-1v-4c0-.729-.195-1.412-.535-2H2.535ZM20 9V8a4 4 0 0 0-4-4h-3v5h7Zm-9-5H8a4 4 0 0 0-4 4v1h7V4Z"/>                
            </svg>
            <h2 class="border border-red-500 max-h-max">Endereço</h2>
        </div>
        
    </div>
</template>

<script>
import axios from 'axios';

    export default {
        name: "HomeView",
        data(){
            return {
                detailHotel: [],
                api: process.env.VUE_APP_API_URL

            }
        },
        
        methods: {
            async getDetail(){
                try {
                    const response = await axios.get(`${this.api}/hotel/all`)
                    if(response.data.success === true && response)
                    {
                        this.detailHotel = response.data.all
                        console.log(this.detailHotel)

                    } else if (response.data.all.length < 0){
                        alert("Não foi encontrado nem um hotel cadastrado!")
                        alert("Por gentileza faça o cadastro do seu hotel!")
                        this.$router.push("/hotel/create")

                    }

                } catch (error) {
                    console.error("Erro", error)

                }
                
            }
        },

        mounted(){
            this.getDetail()

        }

    }
</script>
=======
<script setup>
import TheWelcome from '../components/TheWelcome.vue'
</script>

<template>
  <main>
    <TheWelcome />
  </main>
</template>
>>>>>>> f660198faa681217d34af8b6331dc6571e15791f

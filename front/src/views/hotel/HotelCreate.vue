<template>
    <div>
        <form @submit.prevent="submitForm">
            <input
                type="text" 
                placeholder="Nome do Hotel"
                v-model="form.name"

            />


            <input
                type="text"
                placeholder="CNPJ do Hotel"
                v-model="form.cnpj"
                
            />

            <input
                type="text"
                placeholder="E-mail do Hotel"
                v-model="form.email"

            />

            <input
                type="text"
                placeholder="CEP do Hotel"
                v-model="form.cep"
                maxlength="8"
                @input="getAddres"
            />

            <input
                type="text"
                placeholder="Endereço"
                v-model="form.address"

            />

            <input
                type="text"
                placeholder="Numeró do endereço"
                v-model="form.number"

            />
            
            <input
                type="text"
                placeholder="Numeró de quartos"
                v-model="form.number_of_rooms"

            />

            <input
                type="text"
                placeholder="Numeró de funcionários"
                v-model="form.number_of_employees"

            />
            
            <button type="submit">Criar</button>
        </form>
        
    </div>
</template>

<script>
import axios from 'axios';

    export default {
        name: "HotelCreate",
        data(){
            return {
                form: {
                    name: '',
                    cnpj: '',
                    email: '',
                    cep: '',
                    address: '',
                    number: '',
                    number_of_rooms: '',
                    number_of_employees: ''
                },
                api: process.env.VUE_APP_API_URL

            }
        },

        methods: {
            async getAddres()
            {
                try {
                    if(this.form.cep.length === 8)
                    {
                        const response = await axios.get(`https://viacep.com.br/ws/${this.form.cep}/json/`)
                        
                        this.form.address = response.data.logradouro

                    }

                } catch (error) {
                    console.error("Erro", error)
                    
                }

            },
            async submitForm(){
                try {
                    const form = new FormData;

                    form.append("name", this.form.name)
                    form.append("cnpj", this.form.cnpj)
                    form.append("email", this.form.email)
                    form.append("cep", this.form.cep)
                    form.append("address", this.form.address)
                    form.append("number", this.form.number)
                    form.append("number_of_rooms", this.form.number_of_rooms)
                    form.append("number_of_employees", this.form.number_of_employees)

                    console.log("Rota: ", this.api)
                    const response = await axios.post(`${this.api}/hotel/create`, form)

                    console.log(response)
                    if(response.data.success === true)
                    {
                        alert("Sucesso!")
                        this.$router.push("/");
                    
                    }
                        
                    
                } catch (error) {
                    console.error("Erro", error)
                    
                }

            }

        }
    }
</script>
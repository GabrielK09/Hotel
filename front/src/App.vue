<template>
    <input 
        @input="carrinho"

    >
  
</template>

<script>
    import axios from 'axios';

    export default {
        data()
        {
            return {
                form: {
                    campo1: '',
                    campo2: '',
                    campo3: '',
                    campo4: '',
                },
                produtos_carrinho: []
            }
        },

        methods: {
            pushProduto()
            {

                this.carrinho
                
            },

            async carrinho()
            {

                const response = await axios.post('rota', this.produtos_carrinho)
                console.log(response.data.success)
            }
        },
    
    }
</script>

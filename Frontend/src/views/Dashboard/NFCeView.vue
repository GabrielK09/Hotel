<template>
    <div class="nfce-container">
        <h1 class="title">Emissão NFC-e</h1>

        <!-- Adicionar produto -->
        <div class="add-product">
            <label for="product">Produto:</label>
            <input v-model="newProduct" @input="searchProduct" type="text" id="product" placeholder="Search..." />
            <ul v-if="searchResults" class="search-results">
                <li
                    v-for="product in searchResults"
                    :key="product.id"
                    @click="selectProduct(product)"
                    >
                    {{ product.name }} - R$ {{ product.price.toFixed(2) }}
                </li>
            </ul>
            <button @click="addProduct">Adicionar Produto</button>
        </div>

        <!-- Lista de Produtos -->
         <div class="product-list">
            <h2>Produtos Adicionados:</h2>
            <table>
                <thead>
                    <tr>
                        <th>Produto</th>
                        <th>CSOSN</th>
                        <th>Quantidade</th>
                        <th>Preço</th>
                        <th>Desconto</th>
                        <th>Acréscimo</th>
                        <th>Total</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(product, index) in products" :key="index">
                        <td>{{ product.name }}</td>
                        <td>{{ product.csosn }}</td>
                        <td>{{ product.quantity }}</td>
                        <td>R$ {{ product.price.toFixed(2) }}</td>
                        <td>R$ {{ product.discount.toFixed(2) }}</td>
                        <td>R$ {{ product.addition.toFixed(2) }}</td>
                        <td>R$ {{ total.toFixed(2) }}</td>
                        <td><button @click="removeProduct(index)">Remover</button></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Resumo da venda -->
         <div class="sale-summary">
            <h2>Valores:</h2>
            <p><strong>Total:</strong> R$ {{ total }}</p>
            <button @click="emitNfce">Emitir NFC-e</button>
         </div>
    </div>
</template>

<script>

import { ref, computed } from 'vue'
import axios from "axios";

const quantity = ref(1)
const price = ref(0)
const discount = ref(0)
const addition = ref(0)
const total = computed(() => (quantity.value * price.value) - discount.value + addition.value)

export default {
      data(){
        return {
          newProduct: {
            name: '',
            csosn: '',
            price: '',
            quantity: 1,
            discount: '',
            addition: ''
          },
          products: []
        }
      },

    methods: {
      addProduct() {
        if (!this.newProduct.name){
          alert("Selecione um produto!");
          return;
        }

        this.products.push({ ...this.newProduct });

        this.newProduct = { name: '', price: 0, quantity: 1, discount: 0, addition: 0, csosn: ''}
      },

      removeProduct(index) {
        this.products.splice(index, 1);
      },

      async emitNfce() {
        try {
          const response = await axios.post('http://127.0.0.1:8000/api/nfce/', {
            quantity: quantity.value,
            price: price.value,
            total: total.value
          })

          console.log('Dados enviados!', response.data)
        } catch (error) {
          console.log('Erro ao enviar dados!', error)
        }
      }

        
    },
};
</script>

<style scoped>
.sale-container {
  padding: 20px;
  font-family: Arial, sans-serif;
}

.add-product,
.product-list,
.sale-summary {
  margin-bottom: 20px;
}

.add-product input {
  margin: 5px;
}

.search-results {
  list-style-type: none;
  margin: 0;
  padding: 0;
  border: 1px solid #000000;
  max-height: 150px;
  overflow-y: auto;
}
.search-results li {
  padding: 8px;
  cursor: pointer;
}
.search-results li:hover {
  background-color: #000000;
}

table {
  width: 100%;
  border-collapse: collapse;
}

table th,
table td {
  border: 1px solid #ddd;
  padding: 8px;
  text-align: center;
}

button {
  background-color: #4CAF50;
  color: white;
  border: none;
  padding: 8px 12px;
  cursor: pointer;
}

button:hover {
  background-color: #45a049;
}

.title {
  font-size: 24px;
  margin-bottom: 20px;
}
</style>
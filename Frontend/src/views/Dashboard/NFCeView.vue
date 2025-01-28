<template>
    <div class="nfce-container">
        <h1 class="title">Emissão NFC-e</h1>

        <!-- Adicionar produto -->>
        <div class="add-product">
            <label for="product">Produto:</label>
            <input v-model="newProduct.name" @input="searchProduct" type="text" id="product" placeholder="Search..." />
            <ul v-if="searchResults.length" class="search-results">
                <li
                    v-for="product in searchResults"
                    :key="product.id"
                    @click="selectProduct(product)"
                    >
                    {{ product.name }} - R$ {{ product.price.toFixed(2) }}
                </li>
            </ul>

            <label for="price">Preço:</label>
            <input v-model="newProduct.price" type="number" id="price" placeholder="Preço" />

            <label for="quantity">Quantidade:</label>
            <input v-model="newProduct.quantity" type="number" id="quantity" placeholder="Quantidade" />

            <button @click="addProduct">Adicionar Produto</button>
        </div>

        <!-- Lista de Produtos -->>
         <div class="product-list">
            <h2>Produtos Adicionados:</h2>
            <table>
                <thead>
                    <tr>
                        <th>Produto</th>
                        <th>Quantidade</th>
                        <th>Preço</th>
                        <th>Total</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(product, index) in products" :key="index">
                        <td>{{ product.name }}</td>
                        <td>{{ ProductsView.quantity }}</td>
                        <td>R$ {{ product.price.toFixed(2) }}</td>
                        <td>R$ {{ (product.view * product.price).toFixed(2) }}</td>
                        <td><button @click="removeProduct(index)">Remover</button></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Resumo da venda -->>
         <div class="sale-summary">
            <h2>Resumo da Venda</h2>
            <p><strong>Total:</strong> R$ {{ total.toFixed(2) }}</p>
            <button @click="emitNfce">Emitir NFC-e</button>
         </div>
    </div>
</template>

<script>
import api from "@/services/api"

export default {
    data(){
        return{
            newProduct: {
                name: "",
                price: 0,
                quantity: 1,
            },
            products: [],
        };
    },
    computed: {
        total() {
            return this.products.reduce((sum, product) => {
                return sum + product.price * product.quantity;
            }, 0);
        },
    },
    methods: {
        addProduct() {
            if (this.newProduct.name && this.newProduct.price > 0 && this.newProduct.quantity > 0) {
                this.products.push({ ...this.newProduct });
                this.newProduct.name = "";
                this.newProduct.price = 0;
                this.newProduct.quantity = 1;
            } else {
                alert("Preencha os campos corretamente.");
            }
        },
        removeProduct(index) {
            this.products.splice(index, 1);
        },
        async searchProduct() {
            if (this.newProduct.name.length < 2) {
                this.searchResults = [];
                return;
            }

            try {
                const response = await axios.get(`http://127.0.0.1:8000/api/products/`, {
                    params: { query: this.newProduct.name },
                });
                this.searchResults = response.data;
            } catch (error) {
                console.error("Erro ao buscar produtos:", error);
            }
        },
        selectProduct(product) {
            // Preenche os campos ao selecionar o produto da busca
            this.newProduct.name = product.name;
            this.newProduct.price = product.price;
            this.searchResults = [];
        },
        async emitNfce() {
            if (this.products.length === 0) {
                alert("Adicione ao menos um produto para emitir a NFC-e!");
                return;
            }
            const saleData = {
                products: this.products,
                total: this.total,
                issuedIn: new Date().toISOString(),
            };

            try {
                const response = await axios.post(`http://127.0.0.1:8000/api/nfce/`, saleData);
                alert("NFC-e emitida com sucesso!");
                this.products = [];
            } catch (error) {
                console.error("Erro ao emitir NFC-e:", error);
                alert("Erro ao emitir NFC-e!");
            }
        },
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
  border: 1px solid #ccc;
  max-height: 150px;
  overflow-y: auto;
}
.search-results li {
  padding: 8px;
  cursor: pointer;
}
.search-results li:hover {
  background-color: #f0f0f0;
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
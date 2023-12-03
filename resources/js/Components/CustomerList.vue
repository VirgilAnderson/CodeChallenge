<script>
import { ref, onMounted } from 'vue';
import axios from 'axios';

export default {
    name: 'CustomerList',
    setup() {
        const customers = ref([]);

        const loadCustomers = async () => {
            try {
                const response = await axios.get('/api/customers');
                customers.value = response.data;
            } catch (error) {
                console.error('There was an error fetching the customers:', error);
            }
        };

        onMounted(() => {
            loadCustomers();
        });

        return { customers, loadCustomers };
    },
};
</script>

<template>
    <div class="p-4">
        <button @click="loadCustomers" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Load Customers
        </button>

        <table v-if="customers.length" class="min-w-full leading-normal mt-6">
            <thead>
            <tr>

            </tr>
            </thead>
            <tbody>
            <tr v-for="customer in customers" :key="customer.id">

            </tr>
            </tbody>
        </table>
    </div>
</template>

<style></style>

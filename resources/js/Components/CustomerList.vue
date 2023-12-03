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

        <div class="overflow-x-auto mt-6">
            <table v-if="customers.length" class="min-w-full leading-normal">
                <thead>
                <tr>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Full Name
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Email
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Phone Number
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Address
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="customer in customers" :key="customer.id" class="hover:bg-gray-100">
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        {{ customer.firstName }} {{ customer.lastName }}
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        {{ customer.email }}
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        {{ customer.phone_number }}
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        {{ customer.address }}
                    </td>
                </tr>
                </tbody>
            </table>
            <p v-else class="text-gray-700">No customers found.</p>
        </div>
    </div>
</template>


<style></style>

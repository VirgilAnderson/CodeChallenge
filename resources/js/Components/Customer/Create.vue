<script>
import { ref } from 'vue';
import axios from 'axios';

export default {
    name: 'CustomerCreate',
    setup() {
        const firstName = ref('');
        const lastName = ref('');
        const email = ref('');
        const phoneNumber = ref('');
        const address = ref('');
        const successMessage = ref('');
        const errorMessage = ref('');

        const addCustomer = async () => {
            try {
                await axios.post('/api/customers', {
                    firstName,
                    lastName,
                    email,
                    phoneNumber,
                    address,
                });
                successMessage.value = 'Customer added successfully';
                firstName.value = '';
                lastName.value = '';
                email.value = '';
                phoneNumber.value = '';
                address.value = '';
            } catch (error) {
                errorMessage.value = 'Error adding customer: ' + error.message;
            }
        };

        return {
            firstName,
            lastName,
            email,
            phoneNumber,
            address,
            successMessage,
            errorMessage,
            addCustomer,
        };
    },
};
</script>

<template>
    <div class="p-4">
        <div v-if="successMessage" class="p-3 mb-4 bg-green-200 text-green-800 rounded">
            {{ successMessage }}
        </div>
        <div v-if="errorMessage" class="p-3 mb-4 bg-red-200 text-red-800 rounded">
            {{ errorMessage }}
        </div>
        <input v-model="firstName" type="text" placeholder="First Name" class="p-2 mb-4 border rounded w-full">
        <input v-model="lastName" type="text" placeholder="Last Name" class="p-2 mb-4 border rounded w-full">
        <input v-model="email" type="email" placeholder="Email" class="p-2 mb-4 border rounded w-full">
        <input v-model="phoneNumber" type="tel" placeholder="Phone Number" class="p-2 mb-4 border rounded w-full">
        <input v-model="address" type="text" placeholder="Address" class="p-2 mb-4 border rounded w-full">
        <button @click="addCustomer" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Add Customer
        </button>
    </div>
</template>
<style></style>

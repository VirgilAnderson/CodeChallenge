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
        const formErrors = {
            firstName: ref(''),
            lastName: ref(''),
            email: ref(''),
            phoneNumber: ref(''),
            address: ref('')
        };

        const addCustomer = async () => {
            successMessage.value = '';
            errorMessage.value = '';
            // Clear existing errors
            Object.keys(formErrors).forEach(field => formErrors[field].value = '');

            try {
                await axios.post('/api/customers', {
                    firstName: firstName.value.trim(),
                    lastName: lastName.value.trim(),
                    email: email.value.trim(),
                    phoneNumber: phoneNumber.value.trim(),
                    address: address.value.trim(),
                });
                successMessage.value = 'Customer added successfully';
                // Reset form fields after submission
                firstName.value = '';
                lastName.value = '';
                email.value = '';
                phoneNumber.value = '';
                address.value = '';
            } catch (error) {
                if (error.response && error.response.data && error.response.data.errors) {
                    Object.keys(error.response.data.errors).forEach(field => {
                        const camelCaseField = field.replace(/_\w/g, m => m[1].toUpperCase());
                        formErrors[camelCaseField].value = error.response.data.errors[field][0];
                    });
                    errorMessage.value = 'Please correct the errors and try again.';
                } else {
                    errorMessage.value = 'Error adding customer: ' + error.message;
                }
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
            formErrors,
            addCustomer,
        };
    },
};
</script>

<template>
    <div class="p-4 border-2">
        <div v-if="successMessage" class="p-3 mb-4 bg-green-200 text-green-800 rounded">
            {{ successMessage }}
        </div>
        <div v-if="errorMessage" class="p-3 mb-4 bg-red-200 text-red-800 rounded">
            {{ errorMessage }}
        </div>
        <input v-model="firstName" type="text" placeholder="First Name" class="p-2 mt-4 border rounded w-full">
        <p v-if="formErrors.firstName && formErrors.firstName.value !== ''" class="text-red-500 text-xs pt-2">{{ formErrors.firstName }}</p>
        <input v-model="lastName" type="text" placeholder="Last Name" class="p-2 mt-4 border rounded w-full">
        <p v-if="formErrors.lastName && formErrors.lastName.value !== ''" class="text-red-500 text-xs pt-2">{{ formErrors.lastName }}</p>
        <input v-model="email" type="email" placeholder="Email" class="p-2 mt-4 border rounded w-full">
        <p v-if="formErrors.email && formErrors.email.value !== ''" class="text-red-500 text-xs pt-2">{{ formErrors.email }}</p>
        <input v-model="phoneNumber" type="text" placeholder="Phone Number" class="p-2 mt-4 border rounded w-full">
        <p v-if="formErrors.phoneNumber && formErrors.phoneNumber.value !== ''" class="text-red-500 text-xs pt-2">{{ formErrors.phoneNumber }}</p>
        <input v-model="address" type="text" placeholder="Address" class="p-2 mt-4 border rounded w-full">
        <p v-if="formErrors.address && formErrors.address.value !== ''" class="text-red-500 text-xs pt-2">{{ formErrors.address }}</p>
        <button @click="addCustomer" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 mt-4 rounded">
            Add Customer
        </button>
    </div>
</template>
<style></style>

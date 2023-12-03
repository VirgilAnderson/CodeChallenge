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

<template></template>
<style></style>

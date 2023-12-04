<script>
import CustomerIndex from "./Customer/Index.vue";
import CustomerCreate from "./Customer/Create.vue";
import {ref} from "vue";

export default {
    name: 'App',
    components: {
        CustomerCreate,
        CustomerIndex,
    },
    setup() {
        const customerIndexRef = ref(null);

        const refreshCustomerList = () => {
            if (customerIndexRef.value) {
                customerIndexRef.value.loadCustomers();
            }
        };

        return {
            customerIndexRef,
            refreshCustomerList
        };
    }
};
</script>

<template>
    <div>
        <CustomerIndex ref="customerIndexRef" />
        <CustomerCreate @customer-added="refreshCustomerList" />
    </div>
</template>

<style></style>

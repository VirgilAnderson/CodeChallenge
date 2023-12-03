<script>
import CustomerIndex from "./Customer/Index.vue";
import CustomerCreate from "./Customer/Create.vue";

export default {
    name: 'App',
    components: {
        CustomerCreate,
        CustomerIndex,
    },
    setup() {
        return {};
    },
};
</script>

<template>
    <div>
        <CustomerIndex />
        <CustomerCreate />
    </div>
</template>

<style></style>

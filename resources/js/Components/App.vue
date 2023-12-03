<script>
import CustomerList from './components/CustomerList.vue';

export default {
    name: 'App',
    components: {
        CustomerList,
    },
    setup() {
        return {};
    },
};
</script>

<template>
    <div>
        <h1>Hello Vue!</h1>
        <CustomerList />
    </div>
</template>

<style></style>

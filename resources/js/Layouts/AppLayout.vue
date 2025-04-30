<script setup>
import CustomFooter from '../Components/CustomFooter.vue';
import Navbar from '../Components/Navbar.vue'
import { Head } from '@inertiajs/vue3';

defineProps({
    title: String,
})
</script>
<template>
    <Head :title="title" />

    <Navbar />

    <main>
        <slot></slot>
    </main>

    <CustomFooter />
</template>
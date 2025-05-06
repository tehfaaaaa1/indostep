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
    <div class="min-h-screen">

        <Navbar />
        
        <main class="">
            <slot></slot>
        </main>
    </div>

    <CustomFooter />
</template>
<script setup>
import { Link, useForm } from '@inertiajs/vue3';
import AdminLayout from '../../Layouts/AdminLayout.vue';
import SearchInput from '../../Components/SearchInput.vue';

const form = useForm({
    search: ''
})
</script>
<template>
    <AdminLayout title="Admin|Destination List" atas="true">
        <template #search>
            <SearchInput v-model="form.search" plch="Search Here"/>
        </template>
        <div class="p-8">
            <Link :href="route('admin.destinationCEF')" class="inline-flex items-center px-4 py-2.5 bg-light-green text-dark-green text-xs font-semibold rounded-sm tracking-wider leading-5 hover:bg-transparent hover:ring-1 hover:ring-dark-green transition ease-in-out duration-150">Create Destination</Link>
        </div>
    </AdminLayout>
</template>
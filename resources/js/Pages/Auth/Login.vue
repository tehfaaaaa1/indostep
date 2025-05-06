<script setup>
import AuthCard from '../../Components/AuthCard.vue';
import { Head, useForm } from '@inertiajs/vue3';
import PrimaryButton from '../../Components/PrimaryButton.vue';

const form = useForm({
    email: null,
    password: null,
})
</script>
<template>

    <Head title="Login" />

    <div class="flex h-screen bg-gray-50">
        <div class="basis-1/2">
            <img src="/public/img/login-img.jpg" alt="Login"
                class="border border-light-green object-center w-full h-screen">
        </div>
        <div class="basis-1/2 flex flex-col items-center justify-center">
            <AuthCard class="bg-white">
                <form @submit.prevent="form.post(route('login.post'))">
                    <h1 class="text-xl font-semibold text-center mb-4">Login dulu masbro</h1>
                    <div class="flex flex-col mt-2">
                        <label for="email" class="mb-1">Email</label>
                        <input type="email" name="" id="email" class="border border-gray-500 px-2 py-1" required
                            v-model="form.email">
                        <div v-if="form.errors.email" class="text-red-500 text-sm mt-1">{{ form.errors.email }}</div>
                    </div>
                    <div class="flex flex-col mt-2">
                        <label for="password" class="mb-1">Password</label>
                        <input type="password" name="" id="password" class="border border-gray-500 px-2 py-1" required
                            v-model="form.password">
                        <div v-if="form.errors.password" class="text-red-500 text-sm mt-1">{{ form.errors.password }}</div>
                    </div>
                    <div class="flex flex-col mt-4 items-center">
                        <button type="submit" :disabled="form.processing">
                            <PrimaryButton>Sign In</PrimaryButton>
                        </button>
                    </div>
                </form>
            </AuthCard>
        </div>
    </div>
</template>
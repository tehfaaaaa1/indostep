<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <header class="flex flex-wrap sm:justify-start sm:flex-nowrap w-full bg-white text-sm py-3">
        <nav class="max-w-[85rem] w-full mx-auto px-4 sm:flex sm:items-center sm:justify-between">
            <a class="flex-none font-semibold text-xl text-black focus:outline-hidden focus:opacity-80" href="#"
                aria-label="Brand">Brand</a>
            <ul class="flex flex-row items-center gap-5 mt-5 sm:justify-end sm:mt-0 sm:ps-5">
                <Link :href="route('home')">
                <li class="font-medium text-blue-500 focus:outline-hidden" href="#" aria-current="page">Landing</li>
                </Link>
                <a class="font-medium text-gray-600 hover:text-gray-400 focus:outline-hidden focus:text-gray-400"
                    href="#">Account</a>
                <a class="font-medium text-gray-600 hover:text-gray-400 focus:outline-hidden focus:text-gray-400"
                    href="#">Work</a>
                <a class="font-medium text-gray-600 hover:text-gray-400 focus:outline-hidden focus:text-gray-400"
                    href="#">Blog</a>
            </ul>
        </nav>
    </header>
</template>
<script setup>
import { Link } from '@inertiajs/vue3';
import PrimaryButton from './PrimaryButton.vue';
</script>

<template>
    <header class="flex flex-wrap sm:justify-start sm:flex-nowrap w-full bg-white text-sm py-3">
        <nav class="w-full">
            <div class="sm:flex sm:items-center sm:justify-between max-w-[85rem] mx-auto">
                <Link :href="route('home')"
                    class="flex-none font-light text-2xl focus:outline-hidden focus:opacity-80" href="#"
                    aria-label="Brand">
                <div class="">IndoStep</div>
                </Link>
                <div class="flex items-center gap-x-4">
                    <span class="border-b-4 border-dark-green hover:border-light-green hover:text-gray-500 cursor-pointer me-4">Contact Info</span>
                    <input type="text" name="" id="search" placeholder="SEARCH FOR TRIPS"
                        class="px-3 py-2 border border-gray-500 rounded-sm">
                    <PrimaryButton>
                        RESERVE ONLINE
                    </PrimaryButton>
                </div>
            </div>
            <ul
                class="w-full flex flex-row items-center gap-5 mt-5 sm:justify-around sm:ps-5 bg-dark-green py-3 text-white">
                <!-- <li class="font-medium text-blue-500 focus:outline-hidden" href="#" aria-current="page">Landing</li> -->
                <Link class="font-medium hover:text-light-green focus:outline-hidden focus:text-light-green uppercase"
                    href="#">
                Destinations
                </Link>
                <Link class="font-medium hover:text-light-green focus:outline-hidden focus:text-light-green uppercase"
                    href="#">
                Trip Types
                </Link>
                <Link class="font-medium hover:text-light-green focus:outline-hidden focus:text-light-green uppercase"
                    href="#">
                About Us
                </Link>
            </ul>
        </nav>
    </header>
</template>
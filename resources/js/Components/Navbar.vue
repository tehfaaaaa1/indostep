<script setup>
import { Link, router } from '@inertiajs/vue3';
import PrimaryButton from './PrimaryButton.vue';
</script>

<template>
    <header class="flex flex-wrap sm:justify-start sm:flex-nowrap w-full bg-white text-sm pt-3">
        <nav class="w-full">
            <div class="sm:flex sm:items-center sm:justify-between max-w-[85rem] mx-auto">
                <Link :href="route('home')" class="flex-none font-light text-2xl focus:outline-hidden focus:opacity-80"
                    href="#" aria-label="Brand">
                <img src="/public/img/ineco_logo.jpeg" alt="" class="h-[42px] w-16 object-cover">
                </Link>
                <div class="flex items-center gap-x-4">
                    <Link :href="route('contact')"
                        class="border-b-3 border-dark-green hover:border-light-green hover:text-gray-500 cursor-pointer me-4 font-light">
                    Contact Info
                    </Link>
                    <div class="flex items-center relative">
                        <input type="text" name="" id="search" placeholder="SEARCH FOR TRIPS"
                            class="px-3 py-2.5 border border-gray-500 rounded-sm text-sm text-gray-700 placeholder:text-xs focus:outline-none hover:outline-none focus:border-dark-green focus:ring-dark-green focus:ring-1">
                        <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px"
                            fill="#6a7282" class="absolute right-2 bg-white">
                            <path
                                d="M784-120 532-372q-30 24-69 38t-83 14q-109 0-184.5-75.5T120-580q0-109 75.5-184.5T380-840q109 0 184.5 75.5T640-580q0 44-14 83t-38 69l252 252-56 56ZM380-400q75 0 127.5-52.5T560-580q0-75-52.5-127.5T380-760q-75 0-127.5 52.5T200-580q0 75 52.5 127.5T380-400Z" />
                        </svg>
                    </div>
                    <Link :href="route('reservation.reserve')">
                    <PrimaryButton>
                        RESERVE ONLINE
                    </PrimaryButton>
                    </Link>
                    <div class="flex items-center gap-x-4 ps-4 border-l-2 border-light-green" v-if="$page.props.auth.user?.id">
                        <Link :href="route('admin.destination')">
                            <PrimaryButton>Dashboard</PrimaryButton>
                        </Link>
                        <button @click="router.post(route('logout'), $page.props.auth.user.id)"
                            class="text-red-500 hover:text-red-600 cursor-pointer">
                            Logout
                        </button>
                    </div>
                </div>
            </div>
            <ul
                class="w-full flex flex-row items-center gap-5 mt-3 sm:justify-around sm:ps-5 bg-dark-green py-3 text-white">
                <!-- <li class="font-medium text-blue-500 focus:outline-hidden" href="#" aria-current="page">Landing</li> -->
                <Link class="font-medium hover:text-light-green focus:outline-hidden focus:text-light-green uppercase"
                    :href="route('destination.list')">
                Destinations
                </Link>
                <Link class="font-medium hover:text-light-green focus:outline-hidden focus:text-light-green uppercase"
                    href="#">
                Trip Types
                </Link>
                <Link class="font-medium hover:text-light-green focus:outline-hidden focus:text-light-green uppercase"
                    :href="route('about')">
                About Us
                </Link>
            </ul>
        </nav>
    </header>
</template>
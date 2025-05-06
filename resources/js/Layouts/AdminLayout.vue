<script setup>
import { Head, usePage } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';
// import PrimaryButton from './PrimaryButton.vue';
import NavLink from '../Components/NavLink.vue';
import { computed } from 'vue';
defineProps({
    title: String,
    atas: {
        type: Boolean,
        default: false
    }
})
const currentPage = usePage();
const checkCurrentGroup = computed(() => {
    const path = currentPage.url;
    if (path.startsWith('/admin/destination')) {
        return 'destination';
    } 
})
</script>
<template>

    <Head :title="title" />
    <div class="min-h-screen">
       <!-- Navigation Toggle -->
    <div class="lg:hidden py-16 text-center">
        <button type="button"
            class="py-2 px-3 inline-flex justify-center items-center gap-x-2 text-start bg-gray-800 border border-gray-800 text-white text-sm font-medium rounded-lg shadow-2xs align-middle hover:bg-gray-950 focus:outline-hidden focus:bg-gray-900"
            aria-haspopup="dialog" aria-expanded="false" aria-controls="hs-sidebar-basic-usage"
            aria-label="Toggle navigation" data-hs-overlay="#hs-sidebar-basic-usage">
            Open
        </button>
    </div>
    <!-- End Navigation Toggle -->

    <!-- Sidebar -->
    <div id="hs-sidebar-empty-content"
        class="hs-overlay [--auto-close:lg] lg:block lg:translate-x-0 lg:end-auto lg:bottom-0 w-64 hs-overlay-open:translate-x-0 -translate-x-full transition-all duration-300 transform h-full hidden fixed top-0 start-0 bottom-0 z-[60] bg-white border-e border-gray-200 dark:bg-neutral-800 dark:border-neutral-700"
        role="dialog" tabindex="-1" aria-label="Sidebar">
        <div class="relative flex flex-col h-full max-h-full ">
            <!-- Header -->
            <header class="mt-4 flex justify-center items-center gap-x-2">
                <!-- <img :src="'../image/main-logo.jpg'" alt="" class="w-28"> -->
                <div class="">
                    <h1 class="text-2xl tracking-tight font-semibold leading-2 mt-1">Indo <br><span
                            class="font-black text-dark-green tracking-tighter text-3xl ps-0.5">Step</span></h1>
                </div>
                <div class="lg:hidden -me-2">
                    <!-- Close Button -->
                    <button type="button"
                        class="flex justify-center items-center gap-x-3 size-6 bg-white border border-gray-200 text-sm text-gray-600 hover:bg-gray-100 rounded-full disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-100 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 dark:hover:text-neutral-200 dark:focus:text-neutral-200"
                        data-hs-overlay="#hs-sidebar-empty-content">
                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 6 6 18" />
                            <path d="m6 6 12 12" />
                        </svg>
                        <span class="sr-only">Close</span>
                    </button>
                    <!-- End Close Button -->
                </div>
            </header>
            <!-- End Header -->

            <!-- Body -->
            <nav
                class="h-full mt-5   overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500">
                <div class="flex flex-col justify-between h-full">
                    <div class=" pb-0 w-full flex flex-col flex-wrap ">
                        <NavLink :href="route('admin.destination')" :active="checkCurrentGroup == 'destination'">
                            Destination</NavLink>
                        <NavLink :href="route('admin.destination')" :active="route().current('admin')">Accomodation</NavLink>
                    </div>

                </div>
            </nav>
            <!-- End Body -->
        </div>
    </div>
    <!-- End Sidebar -->

    <nav class="bg-white border-b border-gray-100 xl:ps-64 shadow-xs fixed top-0 left-0 right-0 z-40" v-if="atas">
        <!-- Primary Navigation Menu -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex">
                    <!-- Search -->
                    <div class="shrink-0 flex items-center max-w-md">
                        <slot name="search" />
                    </div>
                </div>
                <div class="">
                    <p class="text-sm tracking-wide pe-8">{{ $page.props.auth.user.name }}</p>
                </div>
            </div>
        </div>
    </nav>
        <main class="ps-64"
        :class="{'mt-14': atas}">
            <slot></slot>
        </main>
    </div>
</template>
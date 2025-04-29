<script setup>
import AppLayout from '../Layouts/AppLayout.vue';

</script>

<template>
    <AppLayout title="Welcome to IndoStep">
        <div class="relative isolate bg-[url(img/hero.jpeg)] bg-cover">
            <div class="mx-auto py-32 sm:py-48 lg:py-56 backdrop-brightness-85">
                <div class="text-center text-white text-shadow-md">
                    <h1
                        class="text-5xl font-semibold tracking-tight text-balance w-fit border-b-4 border-dark-green mx-auto pb-3">
                        Grand Sightseeing and Adventure in Indonesia
                    </h1>
                </div>
            </div>
        </div>

        <div class="relative bg-black-green text-white py-8">
            <div class="container mx-auto">
                <div class="flex gap-x-4">
                    <img src="/public/img/hero.jpeg" alt="" width="600">
                    <div class="">
                        <h2 class="text-lg font-semibold">Ini Apa</h2>
                        <p class="sm:text-sm/6">Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis atque
                            earum id voluptatum
                            accusamus minima ex, a sint quam, dolores sequi molestiae? Commodi tenetur eaque autem
                            impedit aut necessitatibus explicabo!</p>
                    </div>
                </div>
                <div class="my-8"></div>
                <div class="flex gap-x-4">
                    <div class="">
                        <h2 class="text-lg font-semibold">Ini Apa</h2>
                        <p class="sm:text-sm/6">Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis atque
                            earum id voluptatum
                            accusamus minima ex, a sint quam, dolores sequi molestiae? Commodi tenetur eaque autem
                            impedit aut necessitatibus explicabo!</p>
                    </div>
                    <img src="/public/img/hero.jpeg" alt="" width="600">
                </div>
            </div>
        </div>

        <div class="relative py-8 container mx-auto">
            <div class="text-center mb-3">
                <h1 class="text-xl font-semibold">How do You Like to Travel?</h1>
                <p>By train or small ship? In a group of like-minded travelers or with a traveling companion you choose?
                    Select the type of trip you're looking for below.</p>
                <div class="font-semibold tracking-wider mt-4 text-lg">Find Your Next Trip</div>
            </div>
            <div class="flex flex-wrap justify-center-safe gap-2">
                <div class="relative group cursor-pointer">
                    <img src="/public/img/hero.jpeg" alt="" width="400">
                    <p class="absolute inset-x-0 bottom-0 translate-y-2 text-center bg-dark-green/60 text-white opacity-0 group-hover:opacity-100 group-hover:translate-y-0 transition py-2">Raja Ampat</p>
                </div>
                <div class="relative group cursor-pointer">
                    <img src="/public/img/hero.jpeg" alt="" width="400">
                    <p class="absolute inset-x-0 bottom-0 translate-y-2 text-center bg-dark-green/60 text-white opacity-0 group-hover:opacity-100 group-hover:translate-y-0 transition py-2">Raja Ampat</p>
                </div>
                <div class="relative group cursor-pointer">
                    <img src="/public/img/hero.jpeg" alt="" width="400">
                    <p class="absolute inset-x-0 bottom-0 translate-y-2 text-center bg-dark-green/60 text-white opacity-0 group-hover:opacity-100 group-hover:translate-y-0 transition py-2">Raja Ampat</p>
                </div>
                <div class="relative group cursor-pointer">
                    <img src="/public/img/hero.jpeg" alt="" width="400">
                    <p class="absolute inset-x-0 bottom-0 translate-y-2 text-center bg-dark-green/60 text-white opacity-0 group-hover:opacity-100 group-hover:translate-y-0 transition py-2">Raja Ampat</p>
                </div>
                <div class="relative group cursor-pointer">
                    <img src="/public/img/hero.jpeg" alt="" width="400">
                    <p class="absolute inset-x-0 bottom-0 translate-y-2 text-center bg-dark-green/60 text-white opacity-0 group-hover:opacity-100 group-hover:translate-y-0 transition py-2">Raja Ampat</p>
                </div>
                <div class="relative group cursor-pointer">
                    <img src="/public/img/hero.jpeg" alt="" width="400">
                    <p class="absolute inset-x-0 bottom-0 translate-y-2 text-center bg-dark-green/60 text-white opacity-0 group-hover:opacity-100 group-hover:translate-y-0 transition py-2">Raja Ampat</p>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
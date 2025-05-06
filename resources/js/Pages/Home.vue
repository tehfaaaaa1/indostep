<script setup>
import { Link, useForm, usePage } from '@inertiajs/vue3';
import PrimaryButton from '../Components/PrimaryButton.vue';
import AppLayout from '../Layouts/AppLayout.vue';

const props = defineProps({
    island:Object,
    type:Object
})
const form = useForm({
    island: '',
    type: '',
    month:''
})
const subSearch = ()=>{
    form.get('destination.list')
}
</script>

<template>
    <AppLayout title="Welcome to IndoStep">
        <div class="relative isolate bg-[url(img/hero.jpeg)] bg-cover">
            <div class="mx-auto h-[70vh] sm:h-[80vh] lg:h-[90vh] backdrop-brightness-75 flex flex-col justify-around">
                <div class="text-center text-white text-shadow-md">
                    <h1
                        class="sm:text-3xl md:text-4xl lg:text-5xl font-semibold tracking-tight text-balance w-fit mx-auto pb-3">
                        Grand Sightseeing and Adventure in Indonesia
                    </h1>
                    <div class="mx-auto w-fit">
                        <Link class="" :href="route('destination.list')">
                            <h1 class="text-xl font-semibold hover:underline w-fit">View All Trip & Dates</h1>
                        </Link>
                    </div>
                </div>
                <div class="hidden mx-auto box-border lg:block">
                    <h1 class="text-xl text-white text-center tracking-wider mb-2 font-semibold">Find Your Next Trip</h1>
                    <div class="grid grid-cols-4 max-w-6xl gap-2 " >
                        <div class="">
                            <select name="" id="" v-model="form.island"
                            class="py-3 px-4 pe-9 w-full max-h-56 border-gray-200 text-sm focus:border-light-green focus:ring-2 focus:ring-light-green  disabled:opacity-50 disabled:pointer-events-none outline-none bg-white">
                                <option value="">Destination</option>
                                <option v-for="(item, index) in island" :key="index" :value="item.name">{{ item.name }}</option>
                            </select>
                        </div>
    
                        <div class="">
                            <select name="" id="" v-model="form.type"
                            class="py-3 px-4 pe-9  w-full border-gray-200 text-sm focus:border-light-green focus:ring-2 focus:ring-light-green  disabled:opacity-50 disabled:pointer-events-none outline-none bg-white">
                                <option value="">Trip Type</option>
                                <option v-for="(item, index) in type" :key="index" :value="item.name">{{ item.name }}</option>
                            </select>
                        </div>
    
                        <div class="">
                            <select name="" id="" 
                            class="py-3 px-4 pe-9  w-full border-gray-200 text-sm focus:border-light-green focus:ring-2 focus:ring-light-green disabled:opacity-50 disabled:pointer-events-none outline-none bg-white">
                                <option value="">Departure Month</option>
                            </select>
                        </div>
    
                        <div class="">
                            <PrimaryButton type="button" @click="subSearch" class="w-xs !py-3 justify-center uppercase !text-dark-green hover:!text-white">
                                Search
                            </PrimaryButton>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="relative bg-black-green text-white py-8 lg:py-14">
            <div class="container mx-auto max-w-6xl">
                <div class="flex space-x-8 justify-start">
                    <img src="/public/img/hero.jpeg" alt="" width="575">
                    <div class="flex flex-col justify-around items-start py-8">
                        <h2 class="text-3xl font-semibold">Title</h2>
                        <p class="sm:text-sm/6 w-sm">Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis atque
                            earum id voluptatum
                            accusamus minima ex, a sint quam, dolores sequi molestiae? Commodi tenetur eaque autem
                            impedit aut necessitatibus explicabo!</p>
                        <PrimaryButton class="uppercase hover:!bg-white hover:!text-black-green !text-dark-green">View Detail</PrimaryButton>
                    </div>
                </div>
                <div class="my-8 lg:my-16"></div>
                <div class="flex space-x-8 justify-end">
                    <div class="flex flex-col justify-around items-start py-8">
                        <h2 class="text-3xl font-semibold">Title</h2>
                        <p class="sm:text-sm/6 w-sm">Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis atque
                            earum id voluptatum
                            accusamus minima ex, a sint quam, dolores sequi molestiae? Commodi tenetur eaque autem
                            impedit aut necessitatibus explicabo!</p>
                        <PrimaryButton class="uppercase hover:!bg-white hover:!text-black-green !text-dark-green">View Detail</PrimaryButton>
                    </div>
                    <img src="/public/img/hero.jpeg" alt="" width="575">
                </div>
            </div>
        </div>

        <div class="relative py-8 container mx-auto max-w-6xl">
            <div class="text-center mb-3">
                <h1 class="text-2xl font-semibold">How do You Like to Travel?</h1>
                <p>By train or small ship? In a group of like-minded travelers or with a traveling companion you choose?
                    Select the type of trip you're looking for below.</p>
                <div class="font-semibold tracking-wider mt-4 text-lg">Find Your Next Trip</div>
            </div>
            <div class="grid grid-cols-3 gap-2">
                <div class="relative w-fit group cursor-pointer">
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
<script setup>
import { Link } from '@inertiajs/vue3';
import PrimaryButton from '../../Components/PrimaryButtonGua.vue';
import AppLayout from '../../Layouts/AppLayout.vue';
import Biography from '../../Components/Biography.vue';
import { computed, ref } from 'vue';
const props = defineProps({
    destination: Object
})
function getDay(val) {
    const last = val[val.length - 1]
    const day = last.day.slice(-1)
    // console.log(day)
    return day
}
const expertBiog = ref(null)
const searchBio = (id) => {
    const expert = props.destination.expert.find(p => p.id == id)
    expertBiog.value = expert.expert
}
const expertBio = ref(false)
const currentIndex = ref(0);
const totalSlides = computed(() => props.destination.accomodation.length);

const nextSlide = () => {
    currentIndex.value = (currentIndex.value + 1) % totalSlides.value;
};

const prevSlide = () => {
    currentIndex.value = (currentIndex.value - 1 + totalSlides.value) % totalSlides.value;
};

const goToSlide = (index) => {
    currentIndex.value = index;
};
const lct = window.location.origin
</script>
<template>
    <AppLayout title="Destination Detail">
        <div class="hero w-full">
            <img :src="lct + '/img/destination/' + destination.image" alt="">
            <div class="bg-black max-h-[18vh] px-10">
                <div class="grid grid-cols-4 items-center gap-x-5 text-white h-[18vh]">
                    <div class="border-e border-e-white flex items-center justify-center pe-10 h-[10vh]">
                        <h1 class="text-2xl font-bold leading-5 tracking-wide ">{{ props.destination.destination }}</h1>
                    </div>
                    <div class="border-e border-e-white flex items-center justify-center pe-10 h-[10vh]">
                        <h1 class="  tracking-wide text-center uppercase">
                            {{ getDay(props.destination.itinerary) }} Days
                            <br> From {{ Number(props.destination.expedition[0].double_occupancy ??
                                props.destination.expedition[0].single_occupancy).toLocaleString() }}
                        </h1>
                    </div>
                    <div class="border-e  border-e-white flex items-center justify-center pe-10 h-[10vh]">
                        <div class="inline-block text-center">
                            <p class="tracking-wide text-sm text-[#999999]">Trip Type</p>
                            <p class="font-medium tracking-wide">{{ props.destination.type.name }}</p>
                        </div>
                    </div>
                    <div class="border-e  border-e-white flex items-center justify-center pe-10 h-[10vh]">
                        <PrimaryButton class="uppercase !tracking-widest !rounded-none !p-4 !px-12 hover:!bg-white">
                            <Link :href="route('reservation.reserve')">Reserve Online</Link>
                        </PrimaryButton>
                    </div>
                </div>
            </div>
        </div>
        <div class="p-8">
            <div class="overview w-full mt-8 min-h-[40vh] border-b-1 border-dark-green pb-6">
                <h1 class="font-bold text-dark-green text-3xl tracking-wider">Trip Overview</h1>
                <!-- Paragraph -->
                <div class="">
                    <div class="w-full mt-3 " v-for="(item, index) in props.destination.overview.paragraph"
                        :key="index">
                        <p>{{ item.content }}</p>
                    </div>
                </div>
                <!-- Bullet -->
                <div class="mt-5">
                    <ul class="list-disc px-4 space-y-3">
                        <li v-for="(item, index) in props.destination.overview.bullet" :key="index">
                            {{ item.content }}
                        </li>
                    </ul>
                </div>
            </div>


            <Biography :show="expertBio" maxWidth="4xl">
                <template #title>
                    <div class="flex justify-end items-center mx-5">
                        <svg @click="expertBio = false" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-12">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </div>
                </template>
                <template #content>
                    <div class="relative w-full px-10">
                        <div class="border-b-1 border-b-dark-green pb-6">
                            <h1 class="text-4xl font-bold tracking-wide text-black-green"> {{ expertBiog.name }}
                            </h1>
                            <h2 class="text-lg mt-3 font-semibold tracking-widest text-black-green"> {{
                                expertBiog.skill }}</h2>
                        </div>
                        <div class="relative mt-10">
                            <img :src="lct + '/img/expert/' + expertBiog.image" alt="" class="w-2xs float-left mr-4">
                            <p class="text-sm leading-5 tracking-wide text-justify text-black-green ">{{
                                expertBiog.biography }}</p>
                        </div>
                    </div>
                </template>
            </Biography>
            <div class="expert w-full mt-12 min-h-[40vh] border-b-1 border-dark-green pb-6">
                <h1 class="font-bold text-dark-green text-3xl tracking-wider">Expert On This Trip</h1>
                <p class="mt-2 tracking-wide leading-4">A National Geographic Expert will accompany each
                    departure to
                    share insights and rare behind-the-scenes perspectives.</p>
                <div class="grid grid-cols-3 gap-4 mx-auto mt-3 max-w-4xl">

                    <div class="flex flex-col items-center text-center"
                        v-for="(item, index) in props.destination.expert" :key="index">
                        <img :src="lct + '/img/expert/' + item.expert.image"
                            class="rounded-full w-32 h-32 object-cover object-center" />
                        <h1 class="font-semibold mt-6 leading-6 tracking-wider">{{ item.expert.name }}</h1>
                        <h2 class="leading-3 tracking-wide text-sm">{{ item.expert.skill }}</h2>
                        <button class="mt-3 font-bold border-b-2 border-dark-greeen"
                            @click="expertBio = true; searchBio(item.id)">View
                            Bio</button>
                    </div>
                </div>
            </div>


            <div class="itinerary w-full px-4 mt-12 min-h-[40vh] border-b-1 border-dark-green pb-6 mb-4">
                <h1 class=" font-bold text-dark-green text-3xl tracking-wider">Itinerary</h1>
                <div class="w-full p-4 border-2 border-light-green rounded-sm mt-3 "
                    v-for="(item, indexC) in props.destination.itinerary" :key="indexC">
                    <button type="button" @click="item.show = !item.show" :aria-expanded="item.show"
                        :aria-controls="'cItinerary-' + indexC" class="flex justify-between items-center w-full">
                        <div class="flex ">
                            <h1 class="text-2xl font-bold text-dark-green tracking-wider leading-5">
                                Day
                                {{ item.day }}
                            </h1>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-8 text-dark-green transition-transform"
                            :class="{ 'rotate-90': item.show }">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                        </svg>
                    </button>

                    <div :id="'cItinerary-' + indexC" class="overflow-hidden transition-max-h duration-300 ease-in-out"
                        :style="{ maxHeight: item.show ? '500px' : '0', padding: item.show ? '0.5rem 0 0 0' : '0' }">
                        <p>{{ item.content }}</p>
                    </div>
                </div>
            </div>


            <div class="accomoadtion w-full px-4 mt-12 min-h-[70vh] border-b-1 border-dark-green pb-6 mb-4">
                <h1 class=" font-bold text-dark-green text-3xl tracking-wider">Accomodation</h1>
                <p class="mt-1.5 tracking-wider">This expedition features some of the world’s finest
                    accommodations.
                    These hotels and lodges have been selected for their exceptional guest service, splendid
                    amenities
                    and convenient access to the places you explore. In more off-the-beaten-path locations,
                    you’ll stay
                    in the best available accommodations have been selected to ensure your comfort. In many
                    destinations, special dining experiences with traditional entertainment have been arranged
                    to
                    provide a window into local cultures.</p>
                <div class="mt-8">
                    <div class="relative overflow-hidden">
                        <div class="relative flex transition-transform duration-500 ease-in-out"
                            :style="{ transform: `translateX(-${currentIndex * 100}%)` }">
                            <div v-for="(item, index) in props.destination.accomodation" :key="index"
                                class="w-full flex-shrink-0">
                                <img :src="lct + '/img/accomodation/' + item.accomodation.image" alt=""
                                    class="w-full h-auto object-cover">

                            </div>
                        </div>

                        <button @click="prevSlide"
                            class="absolute top-1/2 left-4 transform -translate-y-1/2 bg-gray-800 bg-opacity-50 text-white p-2 rounded-full focus:outline-none">
                            <svg class="w-6 h-6 fill-current" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M9.707 16.707a1 1 0 01-1.414-1.414l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9.5H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                        <button @click="nextSlide"
                            class="absolute top-1/2 right-4 transform -translate-y-1/2 bg-gray-800 bg-opacity-50 text-white p-2 rounded-full focus:outline-none">
                            <svg class="w-6 h-6 fill-current" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10.293 3.293a1 1 0 011.414 1.414l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 10.5H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>

                        <div class="absolute bottom-4 left-0 right-0 flex justify-center space-x-2">
                            <button v-for="(slide, index) in props.destination.accomodation" :key="index"
                                @click="goToSlide(index)"
                                :class="{ 'bg-blue-500': currentIndex === index, 'bg-gray-300': currentIndex !== index }"
                                class="w-3 h-3 rounded-full focus:outline-none"></button>
                        </div>
                    </div>
                    <div class="mt-4">
                        <h1 class="text-xl font-semibold text-black-green tracking-wide">
                            {{ props.destination.accomodation[currentIndex].accomodation?.name }}
                        </h1>
                        <p>{{ props.destination.accomodation[currentIndex]?.accomodation.description }}</p>
                    </div>
                </div>
            </div>


            <div class="Date w-full px-4 mt-12 min-h-[70vh] border-b-1 border-dark-green pb-6 mb-4">
                <h1 class=" font-bold text-dark-green text-3xl tracking-wider">Dates & Prices</h1>
                <div class="flex flex-col">
                    <div class="-m-1.5 overflow-x-auto">
                        <div class="p-1.5 min-w-full inline-block align-middle">
                            <div class="overflow-hidden">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead>
                                        <tr>
                                            <th scope="col"
                                                class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                                Date</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                                Double Occupancy</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                                Single Occupancy</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 ">
                                        <tr class="mt-2" v-for="(item, index) in props.destination.expedition"
                                            :key="index">
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-xl font-semibold tracking-wider">
                                                <p class="">{{ item.date }}</p>
                                            </td>
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-xl font-semibold tracking-wider">
                                                Rp. {{ Number(item.single_occupancy).toLocaleString() }}
                                            </td>
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-xl font-semibold tracking-wider">
                                                Rp. {{ Number(item.double_occupancy).toLocaleString() }}
                                            </td>
                                            <td class="flex justify-end px-6 py-4">
                                                <PrimaryButton
                                                    class=" !tracking-wider !p-4 !px-12">
                                                    <Link :href="route('reservation.reserve')">Reserve now</Link>
                                                </PrimaryButton>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
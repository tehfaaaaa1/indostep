<script setup>
import { ref } from 'vue';
import PrimaryButton from '../../Components/PrimaryButton.vue';
import AppLayout from '../../Layouts/AppLayout.vue';
import { router, usePage, useForm } from '@inertiajs/vue3';
import PrimaryButtonGua from '../../Components/PrimaryButtonGua.vue';

const { props } = usePage();
console.log(props)
const form = useForm({
    destination: null,
    traveler_num: null,
    name: null,
    email: null,
    phone: null,
    message: null,
    dates: null,
})

const accomodation = ref([])
const getAcc = () => {
    const destinstion = props.destination.find(p => p.id == form.destination)
    accomodation.value = destinstion.accomodation
    // console.log(destinstion, accomodation.value)
}
const expedition = ref([])
const getExp = () => {
    const destinstion = props.destination.find(p => p.id == form.destination)
    expedition.value = destinstion.expedition
    // console.log(destinstion, expedition.value)
}
const destination = ref([])
const getDes = () => {
    const destinstion = props.destination.find(p => p.id == form.destination)
    destination.value = destinstion
    // console.log(destinstion, destination.value)
}
const dates = (id) => {
    const exp = expedition.value.find(p => p.id == id)
    form.dates = exp.date
}
const checkDates = (val) => {
    const exp = form.dates == val
    return exp
}
const submit = () => {
    form.post(route('reservation.post'))
}
const lct = window.location.origin
</script>
<template>
    <AppLayout title="Reserve Online">
        <div class="relative py-8 container mx-auto">
            <h1 class="text-center text-2xl font-semibold tracking-wider">Book a Trip</h1>

            <div class="mt-8">
                <h2 class="text-xl font-medium">1. Select Trip Plan</h2>
                <div class="">
                    <p>Select your preferred trip and departure date.</p>
                    <PrimaryButton class="mt-2">All Trips</PrimaryButton>
                    <div class="flex justify-between mt-4 divide-x-2 divide-gray-500">
                        <div class="basis-1/2 pe-6">
                            <h3>Search</h3>
                            <input type="text" name="" id="" class="border border-gray-500 px-2 py-1 w-1/2">
                            <p class="text-sm text-black-green mt-1">Results will show here.</p>
                        </div>
                        <div class="text-lg font-medium px-8">Or</div>
                        <div class="basis-1/2 ps-6">
                            <h3>Find</h3>
                            <select @change="getAcc(); getExp(); getDes()" v-model="form.destination" id=""
                                class="border border-gray-500 w-1/2 px-2 py-1">
                                <option value="">Find your trip</option>
                                <option :value="item.id" v-for="(item, index) in props.destination">
                                    {{ item.destination }}
                                </option>
                            </select>
                        </div>
                    </div>
                    <img :src="`${lct}/img/destination/${destination.image}`" alt="" width="575" v-if="form.destination"
                        class="mt-4">
                    <!-- {{ props.destination[form.destination].image ?? 12 }} -->
                </div>

                <div class="mt-6" v-if="form.destination">
                    <p>Choose your preferred departure date to proceed.</p>
                    <div class="overflow-hidden">
                        <table class="w-full mt-2 divide-y divide-gray-400">
                            <thead>
                                <tr class="text-left">
                                    <th class="font-normal px-6 py-3" scope="col">Date</th>
                                    <th class="font-normal px-6 py-3" scope="col">Price</th>
                                    <th class="font-normal px-6 py-3" scope="col">Select</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="font-light odd:bg-white even:bg-gray-100 hover:bg-gray-100"
                                    v-for="item in expedition" :class="checkDates(item.date) ? 'bg-gray-200' : ''">
                                    <!-- {{ props.destination[form.destination - 1] }} -->
                                    <td class="px-6 py-4">
                                        {{ item.date }}</td>
                                    <td class="px-6 py-4">
                                        Rp. {{ item.price }}</td>
                                    <td class="px-6 py-4">
                                        <PrimaryButtonGua @click="dates(item.id)">Select Dates</PrimaryButtonGua>
                                    </td>
                                    <td v-if="form.dates"><svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"
                                            v-if="checkDates(item.date)">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m4.5 12.75 6 6 9-13.5" />
                                        </svg></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <PrimaryButton class="mt-6 ms-auto">Next</PrimaryButton>
            </div>
            <div class="mt-8">
                <h2 class="text-xl font-medium">2. Traveler Information</h2>
                Please provide information for all Travelers going on the trip. A deposit will be due for each Traveler
                when your reservation is confirmed.
                <div class="text-sm text-gray-800">(<span class="text-red-500">*</span>) Required.</div>
                <div class="mt-4">
                    <label for="number-traveler" class="font-medium text-lg">- Number of Travelers</label>
                    <div class="">
                        <input type="number" name="" id="number-traveler" class="border border-gray-500 px-2 py-1 w-14" v-model="form.traveler_num">
                        Orang
                    </div>
                </div>
                <div class="mt-4 flex flex-col">
                    <h3 class="text-lg font-medium">- Person in Charge (PIC)</h3>
                    <p class="text-sm text-gray-800 mt-1">Note: PIC Must be over 18 years old.</p>
                    <div class="grid grid-cols-3 w-3/4">
                        <div class="flex flex-col mt-2 pe-6">
                            <label for="name-traveler" class="mb-1">Full Name</label>
                            <input type="text" name="" id="name-traveler" class="border border-gray-500 px-2 py-1" v-model="form.name">
                        </div>
                        <div class="flex flex-col mt-2 pe-6">
                            <label for="email" class="mb-1">Email</label>
                            <input type="text" name="" id="email" class="border border-gray-500 px-2 py-1" v-model="form.email">
                        </div>
                        <div class="flex flex-col mt-2 pe-6">
                            <label for="phone-traveler" class="mb-1">Phone Number</label>
                            <input type="number" name="" id="phone-traveler" class="border border-gray-500 px-2 py-1" v-model="form.phone">
                        </div>
                    </div>
                </div>
                <PrimaryButton class="mt-6 ms-auto">Next</PrimaryButton>
            </div>
            <div class="mt-8" v-if="form.destination">
                <h2 class="text-xl font-medium">3. Accomodation</h2>
                <div class="" v-for="(item, index) in accomodation" :key="index">
                    <img :src="lct + '/img/accomodation/' + item.accomodation.image" alt=""
                        class="w-1/2 object-contain object-center h-[500px] mx-auto">
                    <div class="p-3 space-y-2 max-w-1/2 mx-auto">
                        <h1 class="text-lg text-black-green font-semibold tracking-wide">
                            {{ item.accomodation.name }}
                        </h1>
                        <!-- <h2 class="font-medium text-xs tracking-wide uppercase">{{ getDay(item.itinerary) }} Days Starting
                            At</h2> -->
                        <h2 class="font-medium text-xs tracking-wide line-clamp-5 text-gray-700">
                            {{ item.accomodation.description }}
                        </h2>
                        <h2 class="font-medium text-xs tracking-wide text-gray-700">Address: {{
                            item.accomodation.address }}</h2>
                    </div>
                </div>
                <PrimaryButton class="mt-6 ms-auto">Next</PrimaryButton>
            </div>
            <div class="mt-8">
                <h2 class="text-xl font-medium">4. Payment</h2>
                <div class="flex flex-wrap gap-x-4">
                    <img src="/public/img/payment/gopay.png" alt="" width="150" class="object-contain">
                    <img src="/public/img/payment/Logo_dana_blue.png" alt="" width="150" class="object-contain">
                    <img src="/public/img/payment/card.jpg" alt="" width="150" class="object-contain">
                    <img src="/public/img/payment/Logo_ovo_purple.png" alt="" width="150" class="object-contain">
                </div>
                <p>We accept these payments. Press ensure the data is correct before confirming below.</p>
                <div class="flex flex-col mt-2">
                    <label for="message" class="text-sm">Message (Optional)</label>
                    <textarea name="" id="message" v-model="form.message"
                        class="mt-1 w-1/2 min-h-18 border border-gray-300 px-2 py-1"></textarea><br>
                    <span class="text-dark-green">
                        Confirming will send an email to your Person-In-Charge's email address.
                    </span>
                    <!-- <button type="button" @click="router.post(route('reservation.post'))" class="mt-6 ms-auto">
                        <PrimaryButton class="">Confirm</PrimaryButton>
                    </button> -->
                    <button type="button" @click="submit" class="mt-6 ms-auto">
                        <PrimaryButton class="">Confirm</PrimaryButton>
                    </button>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
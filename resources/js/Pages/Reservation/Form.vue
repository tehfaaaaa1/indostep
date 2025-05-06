<script setup>
import PrimaryButton from '../../Components/PrimaryButton.vue';
import AppLayout from '../../Layouts/AppLayout.vue';


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
                            <select name="" id="" class="border border-gray-500 w-1/2 px-2 py-1">
                                <option value="">Find your trip</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="mt-6">
                    <p>Choose your preferred departure date to proceed.</p>
                    <div class="overflow-hidden">
                        <table class="w-full mt-2 divide-y divide-gray-400">
                            <thead>
                                <tr class="text-left">
                                    <th class="font-normal px-6 py-3" scope="col">Date</th>
                                    <th class="font-normal px-6 py-3" scope="col">Double Occupancy</th>
                                    <th class="font-normal px-6 py-3" scope="col">Single Occupancy</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="font-light odd:bg-white even:bg-gray-100 hover:bg-gray-100">
                                    <td class="px-6 py-4">16 May 2025</td>
                                    <td class="px-6 py-4">Rp 400.000</td>
                                    <td class="px-6 py-4">Rp 600.000</td>
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
                        <input type="number" name="" id="number-traveler" class="border border-gray-500 px-2 py-1 w-14">
                        Orang
                    </div>
                </div>
                <div class="mt-4 flex flex-col">
                    <h3 class="text-lg font-medium">- Person in Charge (PIC)</h3>
                    <p class="text-sm text-gray-800 mt-1">Note: PIC Must be over 18 years old.</p>
                    <div class="grid grid-cols-3 w-3/4">
                        <div class="flex flex-col mt-2 pe-6">
                            <label for="name-traveler" class="mb-1">Full Name</label>
                            <input type="text" name="" id="name-traveler" class="border border-gray-500 px-2 py-1">
                        </div>
                        <div class="flex flex-col mt-2 pe-6">
                            <label for="name-traveler" class="mb-1">Email</label>
                            <input type="text" name="" id="name-traveler" class="border border-gray-500 px-2 py-1">
                        </div>
                        <div class="flex flex-col mt-2 pe-6">
                            <label for="phone-traveler" class="mb-1">Phone Number</label>
                            <input type="text" name="" id="phone-traveler" class="border border-gray-500 px-2 py-1">
                        </div>
                    </div>
                </div>
                <PrimaryButton class="mt-6 ms-auto">Next</PrimaryButton>
            </div>
            <div class="mt-8">
                <h2 class="text-xl font-medium">3. Accomodation</h2>
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
                <p>We accept these payments. Press ensure the data is correct before confirming below. <br>
                    <span class="text-dark-green">
                        Confirming will send you an email to your Person-In-Charge's email address.
                    </span>
                </p>
                <PrimaryButton class="mt-6 ms-auto">Confirm</PrimaryButton>
            </div>
        </div>
    </AppLayout>
</template>
<script setup>
import ContactCard from '../Components/ContactCard.vue';
import AppLayout from '../Layouts/AppLayout.vue';


</script>
<template>
    <div>
        <AppLayout title="Contact Us">
            <div class="relative isolate bg-[url(img/hero.jpeg)] bg-cover h-[40vh] bg-center">
                <div class="absolute backdrop-brightness-40 px-4 py-2 bottom-5 left-10">
                    <div class="text-center text-white text-shadow-md">
                        <h1
                            class="text-4xl font-semibold tracking-tight text-balance w-fit border-b-4 border-light-green mx-auto pb-3">
                            Find Us Here
                        </h1>
                    </div>
                </div>
            </div>

            <div class="container mx-auto py-8">
                <div class="flex justify-between items-center gap-x-4">
                    <div class="basis-full grid grid-cols-2 gap-8">
                        <ContactCard>
                            <div class="rounded-full shadow-md p-4 mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" height="32px" viewBox="0 -960 960 960"
                                    width="32px" fill="#000000" class="fill-dark-green">
                                    <path
                                        d="M160-160q-33 0-56.5-23.5T80-240v-480q0-33 23.5-56.5T160-800h640q33 0 56.5 23.5T880-720v480q0 33-23.5 56.5T800-160H160Zm320-280L160-640v400h640v-400L480-440Zm0-80 320-200H160l320 200ZM160-640v-80 480-400Z" />
                                </svg>
                            </div>
                            indostep.group@gmail.com
                        </ContactCard>
                        <ContactCard>
                            <div class="rounded-full shadow-md p-4 mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" height="32px" viewBox="0 -960 960 960"
                                    width="32px" fill="#000000" class="fill-dark-green">
                                    <path
                                        d="M796-120q-119 0-240-55.5T333-333Q231-435 175.5-556T120-796q0-18.86 12.57-31.43T164-840h147.33q14 0 24.34 9.83Q346-820.33 349.33-806l26.62 130.43q2.05 14.9-.62 26.24-2.66 11.33-10.82 19.48L265.67-530q24 41.67 52.5 78.5T381-381.33q35 35.66 73.67 65.5Q493.33-286 536-262.67l94.67-96.66q9.66-10.34 23.26-14.5 13.61-4.17 26.74-2.17L806-349.33q14.67 4 24.33 15.53Q840-322.27 840-308v144q0 18.86-12.57 31.43T796-120ZM233-592l76-76.67-21-104.66H187q3 41.66 13.67 86Q211.33-643 233-592Zm365.33 361.33q40.34 18.34 85.84 29.67 45.5 11.33 89.16 13.67V-288l-100-20.33-75 77.66ZM233-592Zm365.33 361.33Z" />
                                </svg>
                            </div>
                            +62 123-4567-890
                        </ContactCard>
                        <ContactCard>
                            <div class="rounded-full shadow-md p-4 mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" height="32px" viewBox="0 -960 960 960"
                                    width="32px" fill="#000000" class="fill-dark-green">
                                    <path
                                        d="M0-240v-63q0-43 44-70t116-27q13 0 25 .5t23 2.5q-14 21-21 44t-7 48v65H0Zm240 0v-65q0-32 17.5-58.5T307-410q32-20 76.5-30t96.5-10q53 0 97.5 10t76.5 30q32 20 49 46.5t17 58.5v65H240Zm540 0v-65q0-26-6.5-49T754-397q11-2 22.5-2.5t23.5-.5q72 0 116 26.5t44 70.5v63H780Zm-455-80h311q-10-20-55.5-35T480-370q-55 0-100.5 15T325-320ZM160-440q-33 0-56.5-23.5T80-520q0-34 23.5-57t56.5-23q34 0 57 23t23 57q0 33-23 56.5T160-440Zm640 0q-33 0-56.5-23.5T720-520q0-34 23.5-57t56.5-23q34 0 57 23t23 57q0 33-23 56.5T800-440Zm-320-40q-50 0-85-35t-35-85q0-51 35-85.5t85-34.5q51 0 85.5 34.5T600-600q0 50-34.5 85T480-480Zm0-80q17 0 28.5-11.5T520-600q0-17-11.5-28.5T480-640q-17 0-28.5 11.5T440-600q0 17 11.5 28.5T480-560Zm1 240Zm-1-280Z" />
                                </svg>
                            </div>
                            @indostep.group
                        </ContactCard>
                        <ContactCard>
                            <div class="rounded-full shadow-md p-4 mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" height="32px" viewBox="0 -960 960 960"
                                    width="32px" fill="#000000" class="fill-dark-green">
                                    <path
                                        d="M120-120v-560h240v-80l120-120 120 120v240h240v400H120Zm80-80h80v-80h-80v80Zm0-160h80v-80h-80v80Zm0-160h80v-80h-80v80Zm240 320h80v-80h-80v80Zm0-160h80v-80h-80v80Zm0-160h80v-80h-80v80Zm0-160h80v-80h-80v80Zm240 480h80v-80h-80v80Zm0-160h80v-80h-80v80Z" />
                                </svg>
                            </div>
                            Castorice Street No. 1, Jakarta, West Java, Indonesia
                        </ContactCard>
                    </div>
                    <div class="w-fit">
                        <img src="/public/img/contact-img.jpg" alt="" lazy width="800">
                    </div>
                </div>
            </div>
        </AppLayout>
    </div>
</template>
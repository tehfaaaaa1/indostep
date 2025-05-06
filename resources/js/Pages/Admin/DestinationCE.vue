<script setup>
import { useForm } from '@inertiajs/vue3';
import AdminLayout from '../../Layouts/AdminLayout.vue';
import PrimaryButton from '../../Components/PrimaryButtonGua.vue';
import TextInput from '../../Components/TextInput.vue';
import Dropdown from '../../Components/Dropdown.vue';
import DialogModal from '../../Components/DialogModal.vue';
import { onMounted, ref } from 'vue';
import SearchInput from '../../Components/SearchInput.vue';
import axios from 'axios';

const props = defineProps({
    island: Object,
    accomodation: Object,
    type: Object,
    expert: Object
})
const expert = ref(props.expert)
const form = useForm({
    image: '',
    name: '',
    island: '',
    expert: [],
    expertNew: { name: '', skill: '', image: String, bio: '', prev: '', id: null },
    type: '',
    accomodation: '',
    address: '',
    overview: { paragraph: [], bullet: [] },
    itinerary: [],
    prev: ''
})
// overview

const pOverview = ref(form.overview.paragraph.length)
const bOverview = ref(form.overview.bullet.length)
const addParagraphOverview = (type) => {
    let isi = { content: '' }
    if (type == 'p') {
        form.overview.paragraph.push(isi)
        pOverview.value += 1
    }
    else if (type == 'b') {
        form.overview.bullet.push(isi)
        bOverview.value += 1
    }
}

//itinerary
const cItinerary = ref(form.itinerary.length)
const addContentItinerary = () => {
    let isi = { content: '', show: false }
    form.itinerary.push(isi)
    cItinerary.value += 1
}
// expert
const expertModal = ref(false)
async function createExpert() {
    try {
        const response = await axios.post(route('admin.create-expert-ax'), form.expertNew, {
            headers: {
                'Content-Type': 'multipart/form-data', // Penting untuk mengirim file
            },
        })
        const data = ref(response.data.data)
        const allExpert = ref(response.data.expertAll)
        expert.value = allExpert.value
        form.expert.push(data.value)
        console.log(allExpert, form.expert)
    }
    catch (error) {
        if (error) {
            console.error(error)
        }
    }
}
const addExpert = (value) => {
    form.expert.push(value)
}
const checkExpert = (val) => {
    const exp = form.expert.find(p => p.id == val)
    if (!exp) {
        return false
    }
    return true
}
onMounted(() => {
    if (pOverview.value == 0) {
        addParagraphOverview('p')
        addParagraphOverview('b')
    }
    if (cItinerary.value == 0) {
        addContentItinerary()
    }
})
const handleImage = (event) => {
    form.image = event.target.files[0]
    var input = event.target;
    if (input.files) {
        var reader = new FileReader();
        reader.onload = (e) => {
            form.prev = e.target.result;
        }
        reader.readAsDataURL(input.files[0])
    }
}
const handleImageExpert = (event) => {
    form.expertNew.image = event.target.files[0]
    var input = event.target;
    if (input.files) {
        var reader = new FileReader();
        reader.onload = (e) => {
            form.expertNew.prev = e.target.result;
        }
        reader.readAsDataURL(input.files[0])
    }
}
const lct = window.location.origin
</script>
<template>
    <AdminLayout title="Admin|Destination Detail" atas="true">
        <template #search>
            <PrimaryButton class="">
                Save
            </PrimaryButton>
        </template>
        <div class="p-6">
            <div class="border-2 border-gray-200 min-h-screen rounded-sm">
                <!-- Hero -->
                <div class="w-full">
                    <label for="image" class="">
                        <div class="h-[60vh]" v-if="form.prev != '' && form.image != ''">
                            <div class="" v-if="form.prev == ''">

                            </div>
                            <div class="max-h-[60vh]" v-else-if="form.prev != ''">
                                <img :src="form.prev" alt="" class="w-full object-contain h-[60vh]">
                            </div>
                        </div>
                        <div class="h-[60vh] bg-gray-200 flex items-center justify-center"
                            v-if="form.prev == '' || form.image == ''">
                            <div class="text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.2" stroke="currentColor" class="size-28 text-gray-700 mx-auto">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                </svg>
                                <p class="font-medium leading-4 tracking-wide">Image for hero and card</p>
                            </div>
                        </div>
                    </label>
                    <input @input="handleImage($event)" type="file" name="" id="image" multiple class="hidden">
                </div>

                <!-- Name, Type -->
                <div class="mt-3 px-4 flex space-x-6">
                    <TextInput v-model="form.name" plch="Trip Name" />
                    <select v-model="form.island"
                        class="py-3 px-4 pe-9 w-4xs max-h-56 overflow-auto border-b-2 border-dark-green text-sm disabled:opacity-50 disabled:pointer-events-none outline-none bg-white">
                        <option value="">Choose Island</option>
                        <option v-for="(item, index) in props.island" :key="index" :value="item.id">{{ item.name }}
                        </option>
                    </select>
                    <select v-model="form.type"
                        class="py-3 px-4 pe-9 w-4xs max-h-56 border-b-2 border-dark-green text-sm  disabled:opacity-50 disabled:pointer-events-none outline-none bg-white">
                        <option value="">Choose Trip type</option>
                        <option v-for="(item, index) in props.type" :key="index" :value="item.id">{{ item.name }}
                        </option>
                    </select>
                </div>

                <div class="px-6">
                    <!-- Overview -->
                    <div class="w-full mt-8 min-h-[40vh] border-b-1 border-dark-green pb-6">
                        <h1 class="font-bold text-dark-green text-3xl tracking-wider">Trip Overview</h1>
                        <!-- Paragraph -->
                        <div class="">
                            <h1 class="font-semibold text-lg tracking-wide">Paragraph</h1>
                            <div class="w-full mt-3 " v-for="(item, index) in form.overview.paragraph" :key="index">
                                <textarea v-model="item.content"
                                    class="indent-2 p-2 block w-full border-b-2 border-dark-green sm:text-sm !outline-none !ring-0 disabled:opacity-50 disabled:pointer-events-none"
                                    rows="3" placeholder="Paragraph Description"></textarea>
                            </div>
                            <button class="flex space-x-1 mt-2" @click="addParagraphOverview('p')">
                                <p>Add Paragraph</p>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                            </button>
                        </div>
                        <!-- Bullet -->
                        <div class="mt-5">
                            <h1 class="font-semibold text-lg tracking-wide">Bullet</h1>
                            <ul class="list-disc px-4 space-y-3">
                                <li v-for="(item, index) in form.overview.bullet" :key="index">
                                    <TextInput v-model="item.content" plch="Bullet Description" class="!w-md    " />
                                </li>
                            </ul>
                            <button class="flex space-x-1 mt-4" @click="addParagraphOverview('b')">
                                <h1 class="">Add Bullet</h1>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>

                            </button>
                        </div>
                    </div>
                    <!-- Expert -->
                    <DialogModal :show="expertModal" maxWidth="3xl">
                        <template #title>
                            <div class="px-4">
                                <h1 class="text-xl font-semibold tracking-wider text-center">Create New Expert</h1>
                            </div>
                        </template>
                        <template #content>
                            <div class="px-4">
                                <div class="">
                                    <TextInput class="" v-model="form.expertNew.name" plch="Expert Full Name" />
                                </div>
                                <div class="my-4 pb-8 border-b border-dark-green">
                                    <TextInput class="" v-model="form.expertNew.skill" plch="Expert Skill" />
                                </div>
                                <article>
                                    <div class="relative">
                                        <label for="imageEx" class="">
                                            <div class="h-[30vh] w-2xs"
                                                v-if="form.expertNew.prev != '' && form.expertNew.image != ''">
                                                <div class="" v-if="form.expertNew.prev == ''">

                                                </div>
                                                <div class="" v-else-if="form.expertNew.prev != ''">
                                                    <img :src="form.expertNew.prev" alt=""
                                                        class="w-full object-contain h-[30vh]">
                                                </div>
                                            </div>
                                            <div class="h-[30vh] bg-gray-200 flex items-center justify-center w-2xs"
                                                v-if="form.expertNew.prev == '' || form.expertNew.image == ''">
                                                <div class="text-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.2" stroke="currentColor"
                                                        class="size-12 text-gray-700 mx-auto">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                                    </svg>
                                                    <p class="font-medium leading-4 tracking-wide">Image Expert
                                                    </p>
                                                </div>
                                            </div>
                                        </label>
                                        <input @input="handleImageExpert($event)" type="file" name="" id="imageEx"
                                            multiple class="hidden">
                                    </div>
                                    <div class="">
                                        <textarea v-model="form.expertNew.bio"
                                            class="indent-2 p-2 block w-full border-b-2 border-dark-green sm:text-sm !outline-none !ring-0 disabled:opacity-50 disabled:pointer-events-none"
                                            rows="3" placeholder="Paragraph Description"></textarea>
                                    </div>
                                </article>
                            </div>
                        </template>
                        <template #footer>
                            <div class="inline-flex justify-between w-full clear-both">
                                <button type="button"
                                    class="inline-flex items-center px-4 py-3 border-transparent rounded-md bg-red-500 text-white text-xs tracking-wide font-semibold hover:bg-transparent hover:ring-2 hover:ring-red-500 hover:text-red-500 transition duration-150 ease-in-out"
                                    @click="expertModal = false">Close</button>
                                <PrimaryButton @click="expertModal = false; createExpert()"
                                    class="!bg-blue-600 text-white">Submit</PrimaryButton>
                            </div>
                        </template>
                    </DialogModal>

                    <div class="w-full mt-12 min-h-[40vh] border-b-1 border-dark-green pb-6">
                        <h1 class="font-bold text-dark-green text-3xl tracking-wider">Expert On This Trip</h1>
                        <p class="mt-2 tracking-wide leading-4">A National Geographic Expert will accompany each
                            departure to
                            share insights and rare behind-the-scenes perspectives.</p>
                        <div class="flex space-x-2">
                            <Dropdown align="left" class="mt-2 w-fit" >
                                <template #trigger>
                                    <PrimaryButton>Choose Expert</PrimaryButton>
                                </template>
                                <template #content>
                                    <div class="flex flex-col space-y-2 min-h-64">
                                        <SearchInput class="!rounded-none" />
                                            <button type="button" @click="addExpert(item)" 
                                                v-for="(item, index) in expert" :key="index"
                                                :class="checkExpert(item.id) ? 'bg-gray-200':''"
                                                class="cursor-pointer p-2 hover:bg-gray-200 text-start w-full flex justify-between items-center">
                                                <span class="text-sm font-medium">
                                                    {{ item.name + "-" + item.skill }}
                                                </span>
                                                <div class="" v-if="checkExpert(item.id)">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="m4.5 12.75 6 6 9-13.5" />
                                                    </svg>
                                                </div>
                                            </button>

                                        <div class="" v-if="expert.length == 0">
                                            <p class="text-sm text-center tracking-wide font-semibold">Tidak Ada expert
                                            </p>
                                        </div>
                                    </div>
                                </template>
                            </Dropdown>
                            <PrimaryButton @click="expertModal = true"
                                class="!bg-dark-green !text-white mt-2 hover:ring-2 hover:ring-dark-green hover:!bg-transparent hover:!text-dark-green">
                                Create
                                New Expert
                            </PrimaryButton>
                        </div>
                        <div class="grid grid-cols-3 gap-4 mx-auto mt-3 max-w-4xl">
                            <div class="flex flex-col items-center text-center" v-for="(item, index) in form.expert" :key="index">
                                <img :src="lct + '/img/expert/' + item.image" class="rounded-full w-32 h-32 object-cover object-center"/>
                                <h1 class="font-semibold mt-6 leading-6 tracking-wider">{{ item.name }}</h1>
                                <h2 class="leading-3 tracking-wide text-sm">{{ item.skill }}</h2>
                                <button class="mt-3 font-bold border-b-2 border-dark-greeen">View Bio</button>
                            </div>
                        </div>
                    </div>

                    <!-- Itinerary -->
                    <div class="w-full px-4 mt-12 min-h-[40vh] border-b-1 border-dark-green pb-6 mb-4">
                        <h1 class=" font-bold text-dark-green text-3xl tracking-wider">Itinerary</h1>
                        <div class="w-full p-4 border-2 border-light-green rounded-sm mt-3 "
                            v-for="(item, indexC) in form.itinerary" :key="indexC">
                            <button type="button" @click="item.show = !item.show" :aria-expanded="item.show"
                                :aria-controls="'cItinerary-' + indexC"
                                class="flex justify-between items-center w-full">
                                <h1 class="text-2xl font-semibold tracking-wider leading-5 text-dark-green">Day {{
                                    indexC
                                    + 1
                                }}</h1>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor"
                                    class="size-8 text-dark-green transition-transform"
                                    :class="{ 'rotate-90': item.show }">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                                </svg>
                            </button>

                            <div :id="'cItinerary-' + indexC"
                                class="overflow-hidden transition-max-h duration-300 ease-in-out"
                                :style="{ maxHeight: item.show ? '500px' : '0', padding: item.show ? '0.5rem 0 0 0' : '0' }">
                                <textarea v-model="item.content"
                                    class="p-2 block w-full border-b-2 border-dark-green sm:text-sm !outline-none !ring-0 disabled:opacity-50 disabled:pointer-events-none"
                                    rows="3" placeholder="Paragraph Description"></textarea>
                            </div>
                        </div>
                        <button class="flex space-x-1 mt-2" @click="addContentItinerary()" type="button">
                            <p>Add Day</p>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>

                        </button>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
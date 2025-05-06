<script setup>
import { useForm } from '@inertiajs/vue3';
import AdminLayout from '../../Layouts/AdminLayout.vue';
import PrimaryButton from '../../Components/PrimaryButtonGua.vue';
import TextInput from '../../Components/TextInput.vue';
import Dropdown from '../../Components/Dropdown.vue';
import DialogModal from '../../Components/DialogModal.vue';
import Biography from '../../Components/Biography.vue';
import { computed, onMounted, ref } from 'vue';
import SearchInput from '../../Components/SearchInput.vue';
import axios from 'axios';

const props = defineProps({
    island: Object,
    accomodation: Object,
    type: Object,
    expert: Object,
    alrt: String,
    destination: Object
})
const expert = ref(props.expert)
const accomodation = ref(props.accomodation)
const alert = computed(() => props.alrt)
const form = useForm({
    image: props.destination?.image ?? '',
    name: props.destination?.destination,
    island: props.destination?.island_id,
    expert: props.destination?.expert?.map(function (exp) {
        return { id_exdes: exp.id, id: exp.expert.id, name: exp.expert.name, biography: exp.expert.biography, image: exp.expert.image, skill: exp.expert.skill }
    }) ?? [],
    expertNew: { name: '', skill: '', image: String, bio: '', prev: '', id: null },
    type: props.destination?.trip_type_id,
    accomodation: props.destination?.accomodation?.map(function (acc) {
        return { id_desacc: acc.id, id: acc.accomodation.id, name: acc.accomodation.name, description: acc.accomodation.description, image: acc.accomodation.image, address: acc.accomodation.address }
    }) ?? [],
    accomodationNew: { name: '', desc: '', address: '', image: '', prev: '', id: null },
    address: '',
    overview: props.destination?.overview ?? { paragraph: [], bullet: [] },
    itinerary: props.destination?.itinerary ?? [],
    prev: '',
    searchExp: '',
    dates: props.destination?.expedition?.map(function(exp){
        return {id: exp.id, date:exp.date,singleOcc:exp.single_occupancy, doubleOcc: exp.double_occupancy}
    }) ?? [{ date: '', singleOcc: '', doubleOcc: '' }],
    id: props.destination?.id
})
console.log(form.dates)
const save = () => {
    form.post(route('admin.destinationCEB', form.id != '' ? form.id : null), {
        onSuccess: () => {
            setTimeout(() => {
                alrtt.value = true
            }, 500)
            setTimeout(() => {
                alrtt.value = false
            }, 5000)
        }
    })
}
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
    let isi = { day: '', content: '', show: false }
    form.itinerary.push(isi)
    cItinerary.value += 1
}
// expert
const expertModal = ref(false)
const expertBio = ref(false)
const expertBiog = ref(null)
const searchBio = (id) => {
    const expert = form.expert.find(p => p.id == id)
    expertBiog.value = expert
}
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
const searchExp = ref(null)

const selectedExpert = computed(() => {
    if (!props.expert) {
        return [];
    }
    return props.expert.filter(me => {
        const searchQueryLower = searchExp.value ? searchExp.value.toLowerCase() : '';
        const expertNameLower = me.name ? me.name.toLowerCase() : '';

        const searchMatch = expertNameLower.includes(searchQueryLower);

        return searchMatch;
    })
})
const addExpert = (value) => {
    form.expert.push(value)
}
const deleteExpert = (value) => {
    const indexRemove = form.expert.findIndex(e => e.id == value)
    if (indexRemove > -1) {
        form.expert.splice(indexRemove, 1);
    } else {
        console.log('Expert dengan id-' + value + ' tidak ditemukan')
    }
}
const checkExpert = (val) => {
    const exp = form.expert.find(p => p.id == val)
    if (!exp) {
        return false
    }
    return true
}

// Accomodation
const accessCreateModal = ref(false)
async function createAccomodation() {
    try {
        const response = await axios.post(route('admin.create-accomodation-ax'), form.accomodationNew, {
            headers: {
                'Content-Type': 'multipart/form-data', // Penting untuk mengirim file
            },
        })
        const data = ref(response.data.data)
        const allAccomodation = ref(response.data.accomodationAll)
        accomodation.value = allAccomodation.value
        addAcc(data.value)
    }
    catch (error) {
        if (error) {
            console.error(error)
        }
    }
}
const searchAcc = ref(null)
const selectedAccomodation = computed(() => {
    if (!props.accomodation) {
        return [];
    }
    return props.accomodation.filter(me => {
        const searchQueryLower = searchAcc.value ? searchAcc.value.toLowerCase() : '';
        const expertNameLower = me.name ? me.name.toLowerCase() : '';

        const searchMatch = expertNameLower.includes(searchQueryLower);

        return searchMatch;
    })
})
const addAcc = (value) => {
    form.accomodation.push(value)
}
const deleteAcc = (value) => {
    const indexRemove = form.accomodation.findIndex(e => e.id == value)
    if (indexRemove > -1) {
        form.accomodation.splice(indexRemove, 1);
    } else {
        console.log('accomodation dengan id-' + value + ' tidak ditemukan')
    }
}
const checkAcc = (val) => {
    const exp = form.accomodation.find(p => p.id == val)
    if (!exp) {
        return false
    }
    return true
}
const currentIndex = ref(0);
const totalSlides = computed(() => form.accomodation.length);

const nextSlide = () => {
    currentIndex.value = (currentIndex.value + 1) % totalSlides.value;
};

const prevSlide = () => {
    currentIndex.value = (currentIndex.value - 1 + totalSlides.value) % totalSlides.value;
};

const goToSlide = (index) => {
    currentIndex.value = index;
};

const alrtt = ref(false)
// Dates
const addDates = () => {
    let isi = { date: '', singleOcc: '', doubleOcc: '' }
    form.dates.push(isi)
}
onMounted(() => {
    if (pOverview.value == 0) {
        addParagraphOverview('p')
        addParagraphOverview('b')
    }
    if (cItinerary.value == 0) {
        addContentItinerary()
    }
    if (alert.value) {
        setTimeout(() => {
            alrtt.value = true
        }, 500)
        setTimeout(() => {
            alrtt.value = false
        }, 5000)
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
const handleImageAccomodation = (event) => {
    form.accomodationNew.image = event.target.files[0]
    var input = event.target;
    if (input.files) {
        var reader = new FileReader();
        reader.onload = (e) => {
            form.accomodationNew.prev = e.target.result;
        }
        reader.readAsDataURL(input.files[0])
    }
}
const lct = window.location.origin
</script>
<template>
    <AdminLayout title="Admin | Destination Detail" :atas="true">
        <template #search>
            <PrimaryButton class="" @click="save()">
                Save
            </PrimaryButton>
        </template>
        <Transition enter-active-class="transition ease-in duration-100 "
            enter-from-class="transform opacity-0 translate-x-5" enter-to-class="transform opacity-100 translate-x-0"
            leave-active-class="transition ease-out duration-100 delay-0"
            leave-from-class="transform opacity-100 translate-x-0" leave-to-class="transform opacity-0 translate-x-5">
            <div class="fixed right-20 top-20 max-w-sm" v-show="alrtt">
                <div class="bg-teal-50 border-t-2 cursor-pointer border-teal-500 rounded-lg p-4 dark:bg-teal-800/30"
                    role="alert" tabindex="-1" aria-labelledby="hs-bordered-success-style-label" @click="alrtt = false">
                    <div class="flex">
                        <div class="shrink-0">
                            <!-- Icon -->
                            <span
                                class="inline-flex justify-center items-center size-8 rounded-full border-4 border-teal-100 bg-teal-200 text-teal-800 dark:border-teal-900 dark:bg-teal-800 dark:text-teal-400">
                                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z">
                                    </path>
                                    <path d="m9 12 2 2 4-4"></path>
                                </svg>
                            </span>
                            <!-- End Icon -->
                        </div>
                        <div class="ms-3">
                            <h3 id="hs-bordered-success-style-label"
                                class="text-gray-800 font-semibold dark:text-white">
                                Sukses {{ props.alrt }} Data
                            </h3>
                            <p class="text-sm text-gray-700 dark:text-neutral-400">
                                Anda Berhasil {{ props.alrt }} Data .
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </Transition>
        <div class="p-6">
            <div class="border-2 border-gray-200 min-h-screen rounded-sm">
                <!-- Hero -->
                <div class="w-full">
                    <label for="image" class="">
                        <div class="h-[60vh]" v-if="form.prev != '' || form.image != ''">
                            <div class="" v-if="form.prev == '' || form.prev == null">
                                <img :src="lct + '/img/destination/' + form.image" alt=""
                                    class="w-full object-contain h-[60vh]">
                            </div>
                            <div class="max-h-[60vh]" v-else-if="form.prev != ''">
                                <img :src="form.prev" alt="" class="w-full object-contain h-[60vh]">
                            </div>
                        </div>
                        <div class="h-[60vh] bg-gray-200 flex items-center justify-center"
                            v-if="form.prev == '' && form.image == ''">
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
                                    <TextInput v-model="item.content" plch="Bullet Description" class="!w-md" />
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
                                            class="indent-2 p-2 block w-full border-1 rounded-sm border-dark-green sm:text-sm !outline-none !ring-0 disabled:opacity-50 disabled:pointer-events-none"
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
                                    <img :src="lct + '/img/expert/' + expertBiog.image" alt=""
                                        class="w-2xs float-left mr-4">
                                    <p class="text-sm leading-5 tracking-wide text-justify text-black-green ">{{
                                        expertBiog.biography }}</p>
                                </div>
                            </div>
                        </template>
                    </Biography>
                    <div class="w-full mt-12 min-h-[40vh] border-b-1 border-dark-green pb-6">
                        <h1 class="font-bold text-dark-green text-3xl tracking-wider">Expert On This Trip</h1>
                        <p class="mt-2 tracking-wide leading-4">A National Geographic Expert will accompany each
                            departure to
                            share insights and rare behind-the-scenes perspectives.</p>
                        <div class="flex space-x-2">
                            <Dropdown align="left" class="mt-2 w-fit">
                                <template #trigger>
                                    <PrimaryButton>Choose Expert</PrimaryButton>
                                </template>
                                <template #content>
                                    <div class="flex flex-col space-y-2 min-h-64">
                                        <SearchInput v-model="searchExp" class="!rounded-none" plch="Search Expert" />
                                        <button type="button"
                                            @click="checkExpert(item.id) ? deleteExpert(item.id) : addExpert(item)"
                                            v-for="(item, index) in selectedExpert" :key="index"
                                            :class="checkExpert(item.id) ? 'bg-gray-200' : ''"
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
                                            <p class="text-sm text-center tracking-wide font-semibold">Expert Not Found
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
                            <div class="flex flex-col items-center text-center" v-for="(item, index) in form.expert"
                                :key="index">
                                <img :src="lct + '/img/expert/' + item.image"
                                    class="rounded-full w-32 h-32 object-cover object-center" />
                                <h1 class="font-semibold mt-6 leading-6 tracking-wider">{{ item.name }}</h1>
                                <h2 class="leading-3 tracking-wide text-sm">{{ item.skill }}</h2>
                                <button class="mt-3 font-bold border-b-2 border-dark-greeen"
                                    @click="expertBio = true; searchBio(item.id)">View
                                    Bio</button>
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
                                <div class="flex">
                                    Day
                                    <TextInput v-model="item.day" 
                                        class="text-2xl font-semibold tracking-wider leading-5 text-dark-green !p-1 w-12 text-center" />
                                </div>
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

                    <!-- Accomodation -->
                    <DialogModal :show="accessCreateModal">
                        <template #title>
                            <div class="px-4">
                                <h1 class="text-xl font-semibold tracking-wider text-center">Create New Accomodation
                                </h1>
                            </div>
                        </template>
                        <template #content>
                            <div class="px-4">
                                <div class="">
                                    <TextInput :rq="true" class="" v-model="form.accomodationNew.name"
                                        plch="Accomodation Name" />
                                </div>
                                <div class="my-4">
                                    <textarea v-model="form.accomodationNew.address"
                                        class="indent-2 p-2 block w-full border-b-2 border-dark-green sm:text-sm !outline-none !ring-0 disabled:opacity-50 disabled:pointer-events-none"
                                        rows="3" placeholder="Accomodation Address"></textarea>
                                </div>
                                <div class="relative">
                                    <label for="imageAcc" class="">
                                        <div class="min-h-[30vh]"
                                            v-if="form.accomodationNew.prev != '' && form.accomodationNew.image != ''">
                                            <div class="" v-if="form.accomodationNew.prev == ''">

                                            </div>
                                            <div class="w-full flex justify-center items-center"
                                                v-else-if="form.accomodationNew.prev != ''">
                                                <img :src="form.accomodationNew.prev" alt="" class="w-full ">
                                            </div>
                                        </div>
                                        <div class="h-[30vh] bg-gray-200 flex items-center justify-center w-full"
                                            v-if="form.accomodationNew.prev == '' || form.expertNew.image == ''">
                                            <div class="text-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.2" stroke="currentColor"
                                                    class="size-12 text-gray-700 mx-auto">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                                </svg>
                                                <p class="font-medium leading-4 tracking-wide">Image Accomodation
                                                </p>
                                            </div>
                                        </div>
                                    </label>
                                    <input @input="handleImageAccomodation($event)" type="file" name="" id="imageAcc"
                                        multiple class="hidden">
                                </div>
                                <article>
                                    <div class=" mt-5">
                                        <textarea v-model="form.accomodationNew.desc"
                                            class="indent-2 p-2 block w-full border-1 rounded-sm border-dark-green sm:text-sm !outline-none !ring-0 disabled:opacity-50 disabled:pointer-events-none"
                                            rows="3" placeholder="Accomodation Description"></textarea>
                                    </div>
                                </article>
                            </div>
                        </template>
                        <template #footer>
                            <div class="inline-flex justify-between w-full clear-both">
                                <button type="button"
                                    class="inline-flex items-center px-4 py-3 border-transparent rounded-md bg-red-500 text-white text-xs tracking-wide font-semibold hover:bg-transparent hover:ring-2 hover:ring-red-500 hover:text-red-500 transition duration-150 ease-in-out"
                                    @click="accessCreateModal = false">Close</button>
                                <PrimaryButton @click=" accessCreateModal = false; createAccomodation()"
                                    class="!bg-blue-600 text-white">Submit</PrimaryButton>
                            </div>
                        </template>
                    </DialogModal>
                    <div class="w-full px-4 mt-12 min-h-[70vh] border-b-1 border-dark-green pb-6 mb-4">
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
                        <div class="flex space-x-2">
                            <Dropdown align="left" class="mt-2 w-fit">
                                <template #trigger>
                                    <PrimaryButton>Choose Accomodation</PrimaryButton>
                                </template>
                                <template #content>
                                    <div class="flex flex-col space-y-2 min-h-64">
                                        <SearchInput v-model="searchAcc" class="!rounded-none" plch="Search Expert" />
                                        <button type="button"
                                            @click="checkAcc(item.id) ? deleteAcc(item.id) : addAcc(item)"
                                            v-for="(item, index) in selectedAccomodation" :key="index"
                                            :class="checkAcc(item.id) ? 'bg-gray-200' : ''"
                                            class="cursor-pointer p-2 hover:bg-gray-200 text-start w-full flex justify-between items-center">
                                            <span class="text-sm font-medium">
                                                {{ item.name + "-" + item.address }}
                                            </span>
                                            <div class="" v-if="checkAcc(item.id)">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="m4.5 12.75 6 6 9-13.5" />
                                                </svg>
                                            </div>
                                        </button>

                                        <div class="" v-if="selectedAccomodation.length == 0">
                                            <p class="text-sm text-center tracking-wide font-semibold">Accomodation not
                                                Found
                                            </p>
                                        </div>
                                    </div>
                                </template>
                            </Dropdown>
                            <PrimaryButton @click="accessCreateModal = true"
                                class="!bg-dark-green !text-white mt-2 hover:ring-2 hover:ring-dark-green hover:!bg-transparent hover:!text-dark-green">
                                Create Accomodation
                            </PrimaryButton>
                        </div>
                        <div class="mt-8">
                            <div class="relative overflow-hidden">
                                <div class="relative flex transition-transform duration-500 ease-in-out"
                                    :style="{ transform: `translateX(-${currentIndex * 100}%)` }">
                                    <div v-for="(item, index) in form.accomodation" :key="index"
                                        class="w-full flex-shrink-0">
                                        <img :src="lct + '/img/accomodation/' + item.image"
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
                                    <button v-for="(slide, index) in form.accomodation" :key="index"
                                        @click="goToSlide(index)"
                                        :class="{ 'bg-blue-500': currentIndex === index, 'bg-gray-300': currentIndex !== index }"
                                        class="w-3 h-3 rounded-full focus:outline-none"></button>
                                </div>
                            </div>
                            <div class="">
                                <h1 class="text-xl font-semibold text-black-green tracking-wide">
                                    {{ form.accomodation[currentIndex]?.name }}
                                </h1>
                                <p>{{ form.accomodation[currentIndex]?.description }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="w-full px-4 mt-12 min-h-[70vh] border-b-1 border-dark-green pb-6 mb-4">
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
                                                <tr class="mt-2" v-for="(item, index) in form.dates" :key="index">
                                                    <td>
                                                        <input
                                                            class="py-2.5 sm:py-3 px-2 block w-2xs border-b-2 border-dark-green sm:text-sm ring-0 outline-none disabled:opacity-50 disabled:pointer-events-none tracking-wider leading-4"
                                                            type="date" v-model="item.date" />
                                                    </td>
                                                    <td>
                                                        <TextInput v-model="item.singleOcc"
                                                            plch="Single Occupancy Price(Rp)" />
                                                    </td>
                                                    <td>
                                                        <TextInput v-model="item.doubleOcc"
                                                            plch="Double Occupacy Price(Rp)" />
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <button class="flex space-x-1 mt-2" @click="addDates()">
                                            <p>Add date</p>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
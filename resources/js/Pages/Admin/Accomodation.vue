<script setup>
import { Link, useForm } from '@inertiajs/vue3';
import AdminLayout from '../../Layouts/AdminLayout.vue';
import SearchInput from '../../Components/SearchInput.vue';
import TextInput from '../../Components/TextInput.vue';
import { computed, ref } from 'vue';
import PrimaryButton from '../../Components/PrimaryButtonGua.vue';
import DialogModal from '../../Components/DialogModal.vue';

const props = defineProps({
    accomodation: Object
})
const accomodation = ref(props.accomodation)
const form = useForm({
    name:'',
    image:'',
    prev:'',
    address:'',
    desc:'',
    id:''
})
const handleImageAccomodation = (event) => {
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
const editData = (id)=>{
    const data = accomodation.value.find(p=> p.id == id)
    form.id = data.id
    form.name = data.name
    form.address = data.address 
    form.image = data.image
    form.desc = data.description
    console.log(form.image)
    modalCE.value=true
}
const modalCE = ref(false)
const searchVal = ref(null)
const selectedaccomodation = computed(() => {
    if (!accomodation.value) {
        return [];
    }
    return accomodation.value.filter(me => {
        const searchQueryLower = searchVal.value ? searchVal.value.toLowerCase() : '';
        const expertNameLower = me.name ? me.name.toLowerCase() : '';

        const searchMatch = expertNameLower.includes(searchQueryLower);

        return searchMatch;
    })
})
async function createAccomodation() {
    try {
        const response = await axios.post(route('admin.create-accomodation-ax'), form, {
            headers: {
                'Content-Type': 'multipart/form-data', // Penting untuk mengirim file
            },
        })
        const data = ref(response.data.data)
        const allAccomodation = ref(response.data.accomodationAll)
        accomodation.value = allAccomodation.value
    }
    catch (error) {
        if (error) {
            console.error(error)
        }
    }
}
const lct = window.location.origin
</script>
<template>
    <AdminLayout title="Admin|accomodation List" atas="true">
        <template #search>
            <SearchInput v-model="searchVal" plch="Search Here" />
        </template>
        <DialogModal :show="modalCE" maxWidth="3xl">
            <template #title>
                <div class="px-4">
                    <h1 class="text-xl font-semibold tracking-wider text-center">Create New Accomodation
                    </h1>
                </div>
            </template>
            <template #content>
                <div class="px-4">
                    <div class="">
                        <TextInput :rq="true" class="" v-model="form.name" plch="Accomodation Name" />
                    </div>
                    <div class="my-4">
                        <textarea v-model="form.address"
                            class="indent-2 p-2 block w-full border-b-2 border-dark-green sm:text-sm !outline-none !ring-0 disabled:opacity-50 disabled:pointer-events-none"
                            rows="3" placeholder="Accomodation Address"></textarea>
                    </div>
                    <div class="relative">
                        <label for="imageAcc" class="">
                            <div class="min-h-[30vh]"
                                v-if="form.prev != '' || form.image != ''">
                                <div class="" v-if="form.prev == ''">
                                    <img :src="lct+'/img/accomodation/'+form.image" alt="">
                                </div>
                                <div class="w-full flex justify-center items-center"
                                    v-else-if="form.prev != ''">
                                    <img :src="form.prev" alt="" class="w-full ">
                                </div>
                            </div>
                            <div class="h-[30vh] bg-gray-200 flex items-center justify-center w-full"
                                v-if="form.prev == '' && form.image == ''">
                                <div class="text-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.2" stroke="currentColor" class="size-12 text-gray-700 mx-auto">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                    </svg>
                                    <p class="font-medium leading-4 tracking-wide">Image Accomodation
                                    </p>
                                </div>
                            </div>
                        </label>
                        <input @input="handleImageAccomodation($event)" type="file" name="" id="imageAcc" multiple
                            class="hidden">
                    </div>
                    <article>
                        <div class=" mt-5">
                            <textarea v-model="form.desc"
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
                        @click="modalCE = false">Close</button>
                    <PrimaryButton @click=" modalCE = false; createAccomodation()"
                        class="!bg-blue-600 text-white">Submit</PrimaryButton>
                </div>
            </template>
        </DialogModal>
        <div class="p-8">
            <button type="button" @click="modalCE = true"
                class="inline-flex items-center px-4 py-2.5 bg-light-green text-dark-green text-xs font-semibold rounded-sm tracking-wider leading-5 hover:bg-transparent hover:ring-1 hover:ring-dark-green transition ease-in-out duration-150">
            Create accomodation</button>
        </div>
        <div class="p-2 grid grid-cols-3">
            <div class="w-sm border border-gray-200" v-for="(item, index) in selectedaccomodation" :key="index">
                <img :src="lct + '/img/accomodation/' + item.image" alt=""
                    class="w-full object-cover object-center h-54">
                <div class="p-3 space-y-2">
                    <h1 class="text-lg text-black-green font-semibold tracking-wide">{{ item.name }}</h1>
                    <!-- <h2 class="font-medium text-xs tracking-wide uppercase">{{ getDay(item.itinerary) }} Days Starting
                        At</h2> -->
                    <h2 class="font-medium text-xs tracking-wide line-clamp-5 text-gray-700">{{ item.description }}</h2>
                    <h2 class="font-medium text-xs tracking-wide text-gray-700">address: {{ item.address }}</h2>
                    <div class="text-center">
                        <!-- <Link :href="route('admin.accomodationCEF', item.id)"> -->
                        <PrimaryButton @click="editData(item.id)">
                            Edit Data
                        </PrimaryButton>
                        <!-- </Link> -->

                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
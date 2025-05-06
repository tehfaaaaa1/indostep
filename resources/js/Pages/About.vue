<script setup>
import AppLayout from '../Layouts/AppLayout.vue';

</script>
<template>
    <AppLayout title="About Us">
        <div class="relative isolate bg-[url(img/hero.jpeg)] bg-cover h-[40vh] bg-center">
            <div class="absolute backdrop-brightness-40 px-4 py-2 bottom-5 left-10">
                <div class="text-center text-white text-shadow-md">
                    <h1
                        class="text-4xl font-semibold tracking-tight text-balance w-fit border-b-4 border-light-green mx-auto pb-3">
                        About Our Programs
                    </h1>
                </div>
            </div>
        </div>

        <div class="container mx-auto py-8">
            <div class="text-justify not-first:mt-4">
                <h2 class="text-xl font-semibold">About INEco</h2>
                <p>Welcome to INEco, Indonesia Eco-tour, your gateway to responsible adventures in Indonesia's breathtaking natural
                    landscapes and vibrant cultures. We are an ecotourism company dedicated to offering immersive travel
                    experiences that not only showcase the incredible biodiversity and beauty of our archipelago but
                    also prioritize minimal environmental impact and maximum benefit for the local communities who call
                    these places home. Through carefully crafted trips, we aim to connect travelers with nature in a
                    meaningful way, fostering appreciation and contributing directly to conservation efforts.</p>
            </div>
            <div class="text-justify not-first:mt-4">
                <h2 class="text-xl font-semibold">Our Philosophy</h2>
                <p>At INEco, ecotourism is more than just a buzzword; it's the core of our operations. We are committed
                    to ensuring that every journey we facilitate respects the delicate balance of ecosystems and
                    cultural heritage. This means working closely with local guides and communities, supporting small
                    businesses, minimizing waste, promoting conservation awareness among travelers, and contributing a
                    portion of our proceeds to environmental protection and community development projects in the areas
                    we visit. Our goal is to create authentic, enriching experiences that leave a positive footprint.
                </p>
            </div>
            <div class="text-justify not-first:mt-4">
                <h2 class="text-xl font-semibold">Explore with INEco</h2>
                <p>INEco is designed to be your starting point for discovering these unique and responsible
                    travel opportunities. Here, you can explore our range of ecotours, learn about the destinations we
                    visit, understand our commitment to sustainability, and find all the information you need to plan
                    your adventure. We invite you to browse our trip plans and get in touch through our inquiry form –
                    let us help you embark on an unforgettable journey that benefits both you and the precious
                    environments you explore.</p>
            </div>
        </div>
    </AppLayout>
</template>
<script setup>
import { Link } from '@inertiajs/vue3';
</script>
<template>
    <div class="bg-black-green">
        <footer class=" mt-3 pt-10 pb-6 sm:flex sm:justify-evenly max-w-[85rem] mx-auto text-sm border-b-1 border-light-green">
            <div class="max-w-xs">
                <Link :href="route('home')" class="flex-none font-light text-2xl focus:outline-hidden focus:opacity-80 text-white hover:text-light-green">
                IndoStep</Link>
                <div class="text-white tracking-wider mt-1">Grand Sightseeing and Adventure in Indonesia</div>
            </div>
            <div class="text-white">
                <h2 class="text-sm font-medium uppercase mb-3">Menu</h2>
                <ul class="*:hover:text-light-green text-xs tracking-wider space-y-4">
                    <li>
                        <Link href="#">Destinations</Link>
                    </li>
                    <li>
                        <Link href="#">Trip Types</Link>
                    </li>
                    <li>
                        <Link href="#">Reserve Online</Link>
                    </li>
                </ul>
            </div>
            <div class="text-white">
                <h2 class="text-sm font-medium uppercase mb-3">Learn More</h2>
                <ul class="*:hover:text-light-green text-xs tracking-wider space-y-4">
                    <li>
                        <Link href="#">Contact Info</Link>
                    </li>
                    <li>
                        <Link href="#">Terms of Service</Link>
                    </li>
                    <li>
                        <Link href="#">About Us</Link>
                    </li>
                </ul>
            </div>
        </footer>
        <div class="py-4">
            <p class="text-center text-xs text-white tracking-widest">Copyright &copy; 2025 IndoStep Tour Group &bull; All Rights Reserved.</p>
        </div>
    </div>
</template>
<script setup>
import { Link } from '@inertiajs/vue3';
</script>
<template>
    <div class="border-t border-gray-500 mt-3 pt-3 sm:flex sm:justify-evenly max-w-[85rem] mx-auto text-sm">
        <div class="">
            <Link :href="route('home')" class="flex-none font-light text-2xl focus:outline-hidden focus:opacity-80">
            IndoStep</Link>
            <div>Grand Sightseeing and Adventure in Indonesia</div>
        </div>
        <div class="">
            <h2 class="text-base font-semibold">Navigation</h2>
            <ul>
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
        <div class="">
            <h2 class="text-base font-semibold">Our Group</h2>
            <ul>
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
    </div>
    <p class="text-center text-sm my-4">Copyright &copy; 2025 IndoStep Tour Group &bull; All Rights Reserved.</p>
</template>
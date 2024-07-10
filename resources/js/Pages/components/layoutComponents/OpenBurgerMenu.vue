<template>
    <!-- OPENED BURGER MENU -->

    <!-- overlaydiv -->
    <div v-if="burgerMenu" class="overlay">
        <!-- menu -->
        <!-- languages options -->
        <div
            class="w-[220px] h-[496px] bg-black text-white relative z-50 shadow-white-glow flex justify-center items-center flex-col gap-4 uppercase text-base p-6"
        >
            <div class="flex gap-4">
                <div class="hover:text-gray-400 cursor-pointer">en</div>
                <div class="hover:text-gray-400 cursor-pointer">it</div>
            </div>
            <!-- exit button -->
            <div
                class="text-white hover:text-gray-400 hover:scale-105"
                @click="toggleBurgerMenu"
            >
                <svg
                    class="w-16 h-16 hover:text-gray-400 text-white cursor-pointer"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M6 18 18 6M6 6l12 12"
                    />
                </svg>
            </div>
            <div class="hover:text-gray-400 cursor-pointer">our philosophy</div>
            <div class="hover:text-gray-400 cursor-pointer">our dna</div>
            <div class="hover:text-gray-400 cursor-pointer">our cars</div>
            <Link
                :href="route('configure')"
                class="hover:text-gray-400 cursor-pointer"
                :class="`${
                    isActive('configure') ? 'border-b-2 border-white' : ''
                }`"
                >configure</Link
            >
            <Link
                :href="route('findYourDealer')"
                class="hover:text-gray-400 cursor-pointer"
                :class="`${
                    isActive('findYourDealer') ? 'border-b-2 border-white' : ''
                }`"
                >find your dealer</Link
            >
            <div class="hover:text-gray-400 cursor-pointer">news</div>
            <div class="hover:text-gray-400 cursor-pointer">contact</div>
        </div>
    </div>
</template>

<!-- SCRIPT -->
<script setup>
/* IMPORTS */
import { defineModel, computed } from "vue";
import { Link, usePage } from "@inertiajs/vue3";
/* VARIABLES */
const burgerMenu = defineModel("burgerMenu");
const page = usePage();
const currentRoute = computed(() => page.props.route);

/* LOGIC */
function toggleBurgerMenu() {
    return (burgerMenu.value = !burgerMenu.value);
}

//check the value of the current route
function isActive(routeName) {
    return currentRoute.value === routeName;
}
</script>

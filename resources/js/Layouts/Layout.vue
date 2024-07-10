<!-- TEMPLATE - LAYOUT -->
<template>
    <Head :title="`Aehra · ${$page.props.title ? $page.props.title : ''}`" />
    <!-- colors initialization -->
    <!--  <div>
        <div class="bg-CloudWhite"></div>
        <div class="bg-FresoRed"></div>
        <div class="bg-FresoGreen"></div>
        <div class="bg-FresoBlue"></div>
        <div class="bg-FresoPink"></div>
        <div class="bg-FresoLime"></div>
    </div> -->
    <header class="z-30">
        <!-- NAV BAR -->
        <nav class="w-full hidden xl:flex justify-evenly items-center">
            <!-- logo -->
            <div
                class="transition-transform transform hover:scale-105 hover:cursor-pointer ease-in-out blur"
            >
                <a href="https://www.aehra.com/"
                    ><img
                        id="logo"
                        src="/public/images/logo.png"
                        alt="Aehra Logo"
                /></a>
            </div>

            <Link class="hover:text-gray-500">OUR PHILOSOPHY</Link>
            <Link class="hover:text-gray-500">OUR DNA</Link>
            <Link class="hover:text-gray-500">OUR CARS</Link>
            <Link
                :href="route('configure')"
                class="hover:text-gray-500"
                :class="`${
                    isActive('configure') ? 'border-b-2 border-white' : ''
                }`"
                >CONFIGURE</Link
            >
            <Link
                class="hover:text-gray-500"
                :href="route('findYourDealer')"
                :class="`${
                    isActive('findYourDealer') ? 'border-b-2 border-white' : ''
                }`"
                >FIND OUR DEALER</Link
            >
            <Link class="hover:text-gray-500">NEWS</Link>
            <Link class="hover:text-gray-500">CONTACT</Link>
            <div
                class="border border-white p-2 gap-2 flex hover:border-gray-500"
            >
                <Link class="hover:text-gray-500">EN</Link>
                <Link class="hover:text-gray-500">IT</Link>
            </div>
        </nav>
        <!-- BURGER MENU NAVBAR -->
        <nav class="w-full justify-between items-center flex xl:hidden">
            <!-- logo -->
            <div
                class="transition-transform transform hover:scale-105 hover:cursor-pointer ease-in-out blur"
            >
                <a href="https://www.aehra.com/"
                    ><img
                        id="logo"
                        src="/public/images/logo.png"
                        alt="Aehra Logo"
                /></a>
            </div>
            <div class="w-[40px] text-white" @click="toggleBurgerMenu">
                <svg
                    class="w-10 h-10 text-white cursor-pointer hover:text-gray-500"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"
                    />
                </svg>
            </div>
        </nav>
    </header>

    <main>
        <slot>dummy list</slot>
        <!-- OPENED BURGER MENU -->
        <OpenBurgerMenu v-model:burgerMenu="burgerMenu" />
    </main>

    <!-- FOOTER -->
    <footer>
        <div>{{ currentDate }}</div>
        <div>
            © AEHRA AUTOMOBILI S.R.L. Via G. D'Annunzio 23, 20016 Pero (MI)
            Italy - VAT IT11325770961 - Credits
        </div>
    </footer>
</template>

<!-- SCRIPT -->
<script setup>
import { Link, Head, usePage } from "@inertiajs/vue3";
import { ref, onMounted, computed } from "vue";
import OpenBurgerMenu from "@/Pages/components/layoutComponents/OpenBurgerMenu.vue";
const burgerMenu = ref(false);
const page = usePage();
const currentRoute = computed(() => page.props.route);
const currentDate = ref(new Date());

onMounted(() => {
    currentDate.value = new Date();
});

//LOGIC
function toggleBurgerMenu() {
    return (burgerMenu.value = !burgerMenu.value);
}
//check the value of the current route
function isActive(routeName) {
    return currentRoute.value === routeName;
}
</script>

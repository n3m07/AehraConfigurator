<template>
    <Layout>
        <!-- CARS SELECTOR -->
        <div
            class="uppercase w-full flex gap-10 justify-center xl:justify-start items-center"
        >
            <div
                v-for="car in cars"
                :key="car.id"
                :class="[
                    ' hover:activeOption  hover:text-gray-500 cursor-pointer',
                    car.model === selectedModel.model ? 'activeOption' : '',
                ]"
                @click="setSelectedModel(car)"
            >
                {{ car.model }}
            </div>
        </div>
        <!-- CAR IMAGES section WITH SCROLLING BUTTONS -->
        <CurrentImg
            :jpgString="jpgString"
            @setSelectedPicture="currentPicture = $event"
        />

        <!-- current cofiguration string -->
        <div
            class="w-[95vw] md:w-[90vw] xl:w-[80vw] flex justify-center items-center mx-auto border-b-4 border-black mt-5 flex-wrap xl:justify-start gap-1"
        >
            <span>Model: </span
            ><span class="font-bold uppercase">{{ selectedModel.model }}</span>
            <span> Paint: </span
            ><span class="font-bold uppercase">{{
                selectedExteriorPaint
            }}</span>
            <span> Color: </span
            ><span class="font-bold uppercase">{{
                selectedInteriorColor
            }}</span>
            <span> Material: </span
            ><span class="font-bold uppercase">{{
                selectedInteriorMaterial
            }}</span>
            <span> Wheels: </span
            ><span class="font-bold uppercase">{{ selectedTires }}</span>
            <span> Brakes: </span
            ><span class="font-bold uppercase">{{ selectedBrakes }}</span>
        </div>

        <!-- exterior/inteiror/wheels navbar -->
        <div
            class="uppercase flex justify-center gap-10 bg-gray-200 items-center mt-10 max-w-fit mx-auto py-4 px-10"
        >
            <div
                :class="`hover:activeOption ${
                    selectedCustomizationMenu === 'exterior'
                        ? 'activeOption'
                        : ''
                }`"
                @click="setSelectedCustomizationMenu('exterior')"
            >
                exterior
            </div>
            <div
                :class="`hover:border-b-2 hover:border-black ${
                    selectedCustomizationMenu === 'interior'
                        ? 'border-b-2 border-black'
                        : ''
                }`"
                @click="setSelectedCustomizationMenu('interior')"
            >
                interior
            </div>
            <div
                :class="`hover:border-b-2 hover:border-black ${
                    selectedCustomizationMenu === 'wheels'
                        ? 'border-b-2 border-black'
                        : ''
                }`"
                @click="setSelectedCustomizationMenu('wheels')"
            >
                wheels
            </div>
        </div>

        <!-- EXTERIORS CUSTOM MENU component -->
        <ExteriorsMenu
            v-if="selectedCustomizationMenu === 'exterior'"
            :selectedExteriorPaint="selectedExteriorPaint"
            :selectedModel="selectedModel"
            @setSelectedExteriorPaint="selectedExteriorPaint = $event"
        />
        <!-- INTERIORS CUSTOM MENU component -->
        <InteriorsMenu
            v-if="selectedCustomizationMenu === 'interior'"
            :selectedExteriorPaint="selectedExteriorPaint"
            :selectedModel="selectedModel"
            :selectedInteriorColor="selectedInteriorColor"
            :selectedInteriorMaterial="selectedInteriorMaterial"
            @setSelectedInteriorColor="selectedInteriorColor = $event"
            @setSelectedInteriorMaterial="selectedInteriorMaterial = $event"
        />
        <!-- WHEELS CUSTOM MENU component -->
        <WheelsMenu
            v-if="selectedCustomizationMenu === 'wheels'"
            :selectedTires="selectedTires"
            :selectedBrakes="selectedBrakes"
            @setSelectedTires="selectedTires = $event"
            @setSelectedBrakes="selectedBrakes = $event"
            @bookAppointment="bookAppointment"
        />
    </Layout>
</template>

<!-- SCRIPT -->

<script setup>
/* IMPORTS */
import Layout from "@/Layouts/Layout.vue";
import { Head } from "@inertiajs/vue3";
import { ref, watch, computed } from "vue";
import { router } from "@inertiajs/vue3";
//components
import ExteriorsMenu from "@/Pages/components/configureComponents/ExteriorsMenu.vue";
import InteriorsMenu from "@/Pages/components/configureComponents/InteriorsMenu.vue";
import WheelsMenu from "@/Pages/components/configureComponents/WheelsMenu.vue";
import CurrentImg from "@/Pages/components/configureComponents/CurrentImg.vue";

/* VARIABLES */
const props = defineProps(["cars"]);
const defaultCar = props.cars[0];
const selectedModel = ref(defaultCar);
const selectedCustomizationMenu = ref("exterior");
const selectedExteriorPaint = ref(defaultCar.exteriorColor[0]);
const selectedInteriorColor = ref(defaultCar.interiorColor[0]);
const selectedInteriorMaterial = ref(defaultCar.interiorMaterial[0]);
const selectedTires = ref(defaultCar.rims[0]);
const selectedBrakes = ref(defaultCar.brakes[0]);
const currentPicture = ref(1);

/* LOGIC */
const setSelectedModel = (car) => {
    selectedModel.value = car;
};
const setSelectedCustomizationMenu = (option) => {
    selectedCustomizationMenu.value = option;
};
const bookAppointment = () => {
    const data = {
        model: selectedModel.value.model,
        exteriorPaint: selectedExteriorPaint.value,
        interiorColor: selectedInteriorColor.value,
        interiorMaterial: selectedInteriorMaterial.value,
        tires: selectedTires.value,
        brakes: selectedBrakes.value,
    };
    router.get(route("findYourDealer"), data);
};

//function to separate words according to capital letters and add a '-' for separation. the result will be lowercase
function separateWords(str) {
    return str
        .replace(/\s+/g, "") //remove spaces
        .split(/(?=[A-Z])/) //separates to non primary uppercase letters
        .map((word) => word.toLowerCase())
        .join("-");
}

//sets up the value of the string that corresponds to the current img
const jpgString = computed(() => {
    const model = separateWords(selectedModel.value.model);
    const extPaint = separateWords(selectedExteriorPaint.value);
    const intColor = separateWords(selectedInteriorColor.value);
    const intMat = separateWords(selectedInteriorMaterial.value);
    const tires = separateWords(selectedTires.value);
    const brakes = separateWords(selectedBrakes.value);
    const view = () => {
        if (currentPicture.value === 1) {
            return "left";
        } else if (currentPicture.value === 2) {
            return "front";
        } else if (currentPicture.value === 3) {
            return "back";
        } else {
            return "right";
        }
    };
    const string = `${model}_${extPaint}_${intColor}_${intMat}_${tires}_${brakes}_${view()}.jpg`;
    return string;
});
</script>

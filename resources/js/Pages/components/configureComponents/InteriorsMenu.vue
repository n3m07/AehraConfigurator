<template>
    <!-- INTERIORS CUSTOM MENU -->
    <!-- color options and infos -->
    <section>
        <div class="align">
            <div class="uppercase">color:</div>
            <div>{{ selectedInteriorColor }}</div>
            <div class="italic">Included</div>

            <!-- colors selector -->
            <div class="flex flex-wrap justify-center mt-5 gap-5 xl:gap-10">
                <div
                    v-for="color in selectedModel.interiorColor"
                    :key="color"
                    :class="`w-10 h-10 rounded-full border-2  ${
                        selectedInteriorColor === color
                            ? 'border-black'
                            : 'border-slate-400'
                    } hover:border-red-500`"
                    :style="getStyle(color)"
                    @click="setSelectedInteriorColor(color)"
                ></div>
            </div>
        </div>

        <!-- materials options -->
        <div class="align mt-14">
            <div class="uppercase">material</div>
            <div>{{ selectedInteriorMaterial }}</div>
            <div class="italic">Included</div>
            <div class="uppercase flex mx-auto gap-4 mt-2">
                <div
                    @click="setSelectedInteriorMaterial('Leather')"
                    :class="`${
                        selectedInteriorMaterial === 'Leather'
                            ? 'activeOption'
                            : ''
                    } cursor-pointer`"
                >
                    leather
                </div>
                <div
                    @click="setSelectedInteriorMaterial('Alcantara')"
                    :class="`${
                        selectedInteriorMaterial === 'Alcantara'
                            ? 'activeOption'
                            : ''
                    } cursor-pointer`"
                >
                    alcantara
                </div>
            </div>
        </div>
    </section>
</template>

<!-- SCRIPT -->
<script setup>
//IMPORTS
import { ref } from "vue";

//VARIABLES INITIALIZATION
const props = defineProps([
    "selectedExteriorPaint",
    "selectedInteriorColor",
    "selectedModel",
    "selectedInteriorMaterial",
]);
const emit = defineEmits([
    "setSelectedInteriorColor",
    "setSelectedInteriorMaterial",
]);

const selectedInteriorColor = ref(props.selectedInteriorColor);
const selectedInteriorMaterial = ref(props.selectedInteriorMaterial);

//LOGIC
// function to generate dynamic styles
const getStyle = (colorName) => {
    return {
        backgroundColor: `var(--color-${colorName})`,
    };
};

const setSelectedInteriorColor = (color) => {
    selectedInteriorColor.value = color;
    emit("setSelectedInteriorColor", color);
};
const setSelectedInteriorMaterial = (material) => {
    selectedInteriorMaterial.value = material;
    emit("setSelectedInteriorMaterial", material);
};
</script>

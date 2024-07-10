<template>
    <!-- component to show the selected image and the selection buttons -->
    <div class="flex flex-col mt-10 gap-2">
        <!-- img & side buttons -->
        <div class="flex items-center justify-center mx-auto gap-10">
            <!-- side left arrow -->
            <div
                class="w-14 hidden xl:block cursor-pointer hover:scale-105"
                @click="previousPictureButtonHandler"
            >
                <img src="/public/svg/left_arrow.svg" alt="" />
            </div>
            <!-- img -->
            <div
                class="bg-black w-[95vw] md:w-[90vw] xl:w-[70vw] h-[60vh] text-white flex items-center justify-center xl:text-2xl p-4"
            >
                {{ jpgString }}
            </div>
            <!-- side right arrow -->
            <div
                class="w-14 hidden xl:block cursor-pointer hover:scale-105"
                @click="nextPictureButtonHandler"
            >
                <img src="/public/svg/right_arrow.svg" alt="" />
            </div>
        </div>
        <!-- buttons under the image -->
        <div class="w-full flex justify-center items-center gap-12">
            <div
                class="w-6 cursor-pointer hover:scale-105"
                @click="previousPictureButtonHandler"
            >
                <img src="/public/svg/left_arrow.svg" alt="" />
            </div>
            <div
                v-for="n in 4"
                :key="n"
                class="w-4 h-4 rounded-full bg-black hover:bg-gray-400 cursor-pointer hover:scale-105"
                @click="selectedDotHandler(n)"
                :class="`${n === selectedPicture ? 'bg-gray-400' : ''}`"
            ></div>

            <div
                class="w-6 cursor-pointer hover:scale-105"
                @click="nextPictureButtonHandler"
            >
                <img src="/public/svg/right_arrow.svg" alt="" />
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, watch } from "vue";
const props = defineProps(["jpgString"]);
const emit = defineEmits(["setSelectedPicture"]);
const selectedPicture = ref(1);

//SECTION FOR PICTURES SELECTION
//buttons to select the next picture
const nextPictureButtonHandler = () => {
    if (selectedPicture.value < 4) {
        return (selectedPicture.value += 1);
    } else {
        return (selectedPicture.value = 1);
    }
};
//buttons to select the previous picture
const previousPictureButtonHandler = () => {
    if (selectedPicture.value > 1) {
        return (selectedPicture.value -= 1);
    } else {
        return (selectedPicture.value = 4);
    }
};
//logic of the picture selection according to the clicked dot
const selectedDotHandler = (value) => {
    return (selectedPicture.value = value);
};

//emits the value of the selected picture to the parent component
watch(selectedPicture, () => {
    emit("setSelectedPicture", selectedPicture.value);
});
</script>

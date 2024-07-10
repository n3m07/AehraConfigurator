<template>
    <section>
        <!-- rims and tires pics and infos -->
        <div class="align">
            <div class="uppercase">Rims & Tires</div>
            <div>{{ selectedTires }}</div>
            <div class="italic">Included</div>
            <!-- wheels pics -->
            <div class="flex justify-center">
                <div
                    :class="`w-25 ${
                        selectedTires === 'Long Range' ? 'activeOption' : ''
                    }`"
                    @click="setSelectedTires('Long Range')"
                >
                    <img
                        src="/public/images/LongRangeTires.png"
                        alt="Long Range Tires"
                    />
                </div>
                <div
                    :class="`w-25 ${
                        selectedTires === 'Short Range' ? 'activeOption' : ''
                    }`"
                    @click="setSelectedTires('Short Range')"
                >
                    <img
                        src="/public/images/ShortRangeTires.png"
                        alt="Short Range Tires"
                    />
                </div>
            </div>
        </div>
        <!-- purchase both tires & rims options -->
        <div class="mt-14 align">
            <div>Purchase both tires & rims options</div>
            <div>Oncast <span class="italic">€20.000</span></div>
            <button class="uppercase button mt-2">Select Both</button>
        </div>
        <!-- brakes infos and pictures -->
        <div class="mt-14 align">
            <div class="uppercase">breaks</div>
            <div>{{ selectedBrakes }}</div>
            <div class="italic">included</div>
            <!-- brakes pictures -->
            <div class="flex gap-4">
                <div
                    :class="`w-25 ${
                        selectedBrakes === 'yellow' ? 'activeOption' : ''
                    }`"
                    @click="setSelectedBrakes('yellow')"
                >
                    <img
                        src="/public/images/brakeYellow.png"
                        alt="yellow brakes"
                    />
                </div>
                <div
                    :class="`w-25 ${
                        selectedBrakes === 'black' ? 'activeOption' : ''
                    }`"
                    @click="setSelectedBrakes('black')"
                >
                    <img
                        src="/public/images/brakeBlack.png"
                        alt="black brakes"
                    />
                </div>
                <div
                    :class="`w-25 ${
                        selectedBrakes === 'red' ? 'activeOption' : ''
                    }`"
                    @click="setSelectedBrakes('red')"
                >
                    <img src="/public/images/brakeRed.png" alt="red brakes" />
                </div>
            </div>
        </div>
        <!-- book an appointment -->
        <div class="mt-14 align">
            <div class="p-4 font-semibold">
                Send yout configuration to the nearest dealer and book an
                appointment
            </div>
            <button
                class="uppercase py-3 px-10 border-2 border-black"
                @click="bookAppointment"
            >
                book an appointment
            </button>
        </div>
    </section>
</template>

<script setup>
//imports
import { ref } from "vue";

//variables
const props = defineProps(["selectedTires", "selectedBrakes"]);
const emit = defineEmits([
    "setSelectedTires",
    "setSelectedBrakes",
    "bookAppointment",
]);
const selectedTires = ref(props.selectedTires);
const selectedBrakes = ref(props.selectedBrakes);

//logic
const setSelectedTires = (tires) => {
    selectedTires.value = tires;
    emit("setSelectedTires", tires);
};
const setSelectedBrakes = (brakes) => {
    selectedBrakes.value = brakes;
    emit("setSelectedBrakes", brakes);
};
const bookAppointment = () => {
    emit("bookAppointment");
};
</script>

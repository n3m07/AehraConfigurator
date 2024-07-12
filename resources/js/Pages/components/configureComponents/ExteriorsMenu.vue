<template>
    <!-- EXTERIORS CUSTOM MENU -->
    <!-- paint options and infos -->
    <section>
        <div class="align">
            <div class="uppercase">Paint:</div>
            <div>{{ selectedExteriorPaint }}</div>
            <div class="italic">Included</div>
            <!-- paint selector -->
            <div class="flex flex-wrap justify-center gap-5 mt-5 xl:gap-10">
                <div
                    v-for="color in selectedModel.exteriorColor"
                    :key="color"
                    :class="`w-10 h-10 rounded-full border-2  ${
                        selectedExteriorPaint === color
                            ? 'border-black'
                            : 'border-slate-400'
                    } hover:border-red-500`"
                    :style="getStyle(color)"
                    @click="setSelectedExteriorPaint(color)"
                ></div>
            </div>
        </div>

        <!-- tailormade pait section -->
        <div class="gap-2 align mt-14">
            <div class="uppercase">have your paint tailormade</div>
            <div>Estimate cost €20,000 - €50,000</div>
            <!-- talk to a paint specialist button -->
            <div
                v-if="!succMessage"
                class="mt-2 cursor-pointer button"
                @click="togglePaintSpecialistMenu"
            >
                speak to aehra's paint specialist
            </div>
            <div
                v-if="succMessage"
                class="mt-2 text-green-500 uppercase button_white"
            >
                {{ succMessage }}
            </div>
        </div>
    </section>
    <!-- PAINT SPECIALIST POP-UP MENU -->
    <div v-if="paintSpecialistMenu" class="overlay">
        <div
            class="w-[90vw] md:w-[50vw] md:h-[60vh] h-[80vh] bg-white relative z-50 shadow-lg flex justify-center items-center flex-col uppercase text-sm md:text-base p-10"
        >
            <div
                class="flex flex-col items-center justify-center w-full h-full gap-1 md:gap-4"
            >
                <div class="hover:scale-105" @click="togglePaintSpecialistMenu">
                    <svg
                        class="w-10 h-10 cursor-pointer md:w-14 md:h-14"
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
                <form
                    @submit.prevent="paintSpecialist"
                    action=""
                    method="post"
                    class="flex flex-col items-center justify-center w-full"
                >
                    <div class="flex flex-col w-full">
                        <label for="fullName" class="">Full Name</label>
                        <input
                            type="text"
                            name="fullName"
                            id="fullName"
                            placeholder="Cica Lino"
                            required
                            v-model="formData.fullName"
                        />
                        <div v-if="errors['fullName']" class="error">
                            {{ errors["fullName"] }}
                        </div>

                        <label for="email" class="mt-4">E-mail</label>
                        <input
                            type="email"
                            name="email"
                            placeholder="cicalino@gmail.com"
                            id="email"
                            required
                            v-model="formData.email"
                        />
                        <div v-if="errors['email']" class="error">
                            {{ errors["email"] }}
                        </div>
                        <label for="phoneNumber" class="mt-4"
                            >Phone number</label
                        >
                        <input
                            type="text"
                            name="phoneNumber"
                            placeholder="+39-xxxxxxxxxx"
                            id="phoneNumber"
                            required
                            v-model="formData.phoneNumber"
                        />
                        <div v-if="errors['phoneNumber']" class="error">
                            {{ errors["phoneNumber"] }}
                        </div>

                        <label for="privacy" class="mt-4">Privacy</label>
                        <div class="flex flex-wrap items-center gap-2">
                            <input
                                type="checkbox"
                                name="privacy"
                                id="privacy"
                                required
                                v-model="formData.privacy"
                            />
                            <label for="privacy"
                                >I consent to the processing of my personal
                                data.</label
                            >
                            <div v-if="errors['privacy']" class="error">
                                {{ errors["privacy"] }}
                            </div>
                        </div>
                    </div>
                    <!-- submit button -->

                    <button
                        type="submit"
                        class="w-full px-6 py-2 mt-4 uppercase border-2 border-black align"
                    >
                        submit
                    </button>
                </form>
            </div>
        </div>
    </div>
</template>

<!-- SCRIPT -->
<script setup>
//IMPORTS
import { ref, defineModel, computed } from "vue";
import { router, usePage } from "@inertiajs/vue3";

//VARIABLES INITIALIZATION
const props = defineProps(["selectedExteriorPaint", "selectedModel"]);
const emit = defineEmits(["setSelectedExteriorPaint"]);
const selectedExteriorPaint = ref(props.selectedExteriorPaint);
const paintSpecialistMenu = ref(false);
const formData = ref({
    fullName: "",
    email: "",
    phoneNumber: "",
    privacy: false,
});
const page = usePage();
const errors = computed(() => {
    return page.props.errors;
});
const succMessage = computed(() => {
    return page.props.flash.message;
});

//LOGIC
// function to generate dynamic styles
const getStyle = (colorName) => {
    return {
        backgroundColor: `var(--color-${colorName})`,
    };
};
const setSelectedExteriorPaint = (color) => {
    selectedExteriorPaint.value = color;
    emit("setSelectedExteriorPaint", color);
};
function togglePaintSpecialistMenu() {
    return (paintSpecialistMenu.value = !paintSpecialistMenu.value);
}

// function to post the paint specialist form request
const paintSpecialist = () => {
    const personalData = formData.value;
    //***NOTE FOR MYSELF the formData obj gets automatically destructured so it has to be accessed in the controller as separate variables.
    router.post(route("paintSpecialist"), personalData, {
        onSuccess: () => {
            formData.value = {
                fullName: "",
                email: "",
                phoneNumber: "",
                privacy: false,
            };
            paintSpecialistMenu.value = false;
        },
    });
    console.log(personalData);
};
</script>

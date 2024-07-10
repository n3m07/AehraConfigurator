<template>
    <Layout>
        <!-- INTRO INFO -->
        <div class="px-4">
            <h1 class="mb-4">Find your dealer</h1>
            <h3>
                To find the closest AEHRA dealer to you, please fill in the
                information below.
            </h3>
        </div>
        <!-- YOUR CUSTOM CAR SELECTION component-->
        <SelectedConfiguration :configurationData="configurationData" />

        <!-- SELECT LOCATION SECTION -->
        <div class="mt-14 p-4 flex flex-col w-full items-center">
            <!-- country selector -->
            <div class="flex flex-col w-full xl:w-[60vw]">
                <h3>Coutry</h3>
                <select name="countrySelect" v-model="selectedCountry">
                    <option disabled value="">Select a country</option>
                    <option
                        v-for="country in countries"
                        :key="country.id"
                        :value="country.country"
                    >
                        {{ country.country }}
                    </option>
                </select>
                <div v-if="errors.selectedCountry" class="error">
                    {{ errors.selectedCountry }}
                </div>
            </div>
            <!-- city selector -->
            <div
                class="flex flex-col w-full mt-6 xl:w-[60vw]"
                v-if="selectedCountry"
            >
                <h3>City</h3>
                <select name="citySelect" v-model="selectedCity">
                    <option disabled value="">Select a city</option>
                    <option
                        v-for="city in computedCities"
                        :key="city.id"
                        :value="city.city"
                    >
                        {{ city.city }}
                    </option>
                </select>
                <div v-if="errors.selectedCity" class="error">
                    {{ errors.selectedCity }}
                </div>
            </div>
            <!-- adress selector -->
            <div
                class="flex flex-col w-full mt-6 xl:w-[60vw]"
                v-if="selectedCity"
            >
                <h3>Address</h3>
                <select name="addressSelect" v-model="selectedAddress">
                    <option disabled value="">Select an address</option>
                    <option
                        v-for="(address, index) in computedAddresses"
                        :key="index"
                        :value="address.address"
                    >
                        {{ address.address }}
                    </option>
                    <div v-if="errors.selectedAddress" class="error">
                        {{ errors.selectedAddress }}
                    </div>
                </select>
            </div>
            <!-- display selected dealer -->
            <div class="h3 mt-4 flex gap-2 flex-wrap xl:w-[60vw] justify-start">
                <span>Selected dealer: </span>
                <span v-if="selectedAddress">{{ selectedAddress }}, </span>
                <span v-if="selectedCity">{{ selectedCity }}, </span>
                <span v-if="selectedCountry">{{ selectedCountry }}</span>
            </div>
        </div>
        <!-- MAPS API component -->
        <div class="p-4 z-0 flex justify-center w-full h-full">
            <SlippyMap
                :selectedAddress="selectedAddress"
                :computedAddresses="computedAddresses"
            />
        </div>

        <!-- BOOK AN APPOINTMENT FORM -->
        <div class="p-4 mt-10" v-if="!successFormSubmit.val">
            <form
                @submit.prevent="bookAppointment"
                action=""
                method="post"
                class="flex flex-col w-full p-10 border border-black items-center"
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
                    <div v-if="errors['personalData.fullName']" class="error">
                        {{ errors["personalData.fullName"] }}
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
                    <div v-if="errors['personalData.email']" class="error">
                        {{ errors["personalData.email"] }}
                    </div>
                    <label for="phoneNumber" class="mt-4">Phone number</label>
                    <input
                        type="text"
                        name="phoneNumber"
                        placeholder="+39-xxxxxxxxxx"
                        id="phoneNumber"
                        required
                        v-model="formData.phoneNumber"
                    />
                    <div
                        v-if="errors['personalData.phoneNumber']"
                        class="error"
                    >
                        {{ errors["personalData.phoneNumber"] }}
                    </div>

                    <label for="privacy" class="mt-4">Privacy</label>
                    <div class="flex gap-2 items-center">
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
                        <div
                            v-if="errors['personalData.privacy']"
                            class="error"
                        >
                            {{ errors["personalData.privacy"] }}
                        </div>
                    </div>
                </div>
                <!-- submit button -->
                <div class="w-full flex flex-col items-center">
                    <button
                        type="submit"
                        class="mt-4 border-2 border-black uppercase px-6 py-2 max-w-fit"
                    >
                        book an appointment
                    </button>
                    <!-- send pdf via email checkbox -->
                    <div class="flex gap-2 items-center mt-4">
                        <input
                            type="checkbox"
                            name="sendEmail"
                            id="sendEmail"
                            v-model="formData.sendEmail"
                        />
                        <label for="sendEmail"
                            >Send me my configuration as a PDF via E-mail</label
                        >
                    </div>
                </div>
            </form>
        </div>
        <div
            v-if="successFormSubmit.val"
            class="p-4 mt-10 w-[80vw] xl:w-[60vw] h-[20vh] border border-black flex justify-center items-center text-base uppercase align"
        >
            {{ successFormSubmit.message }}
        </div>
    </Layout>
</template>

<!-- SCRIPT -->

<script setup>
//IMPORTS
import Layout from "@/Layouts/Layout.vue";
import { Link, Head, useForm } from "@inertiajs/vue3";
import { ref } from "vue";
import { computed, watch } from "vue";
import { router, usePage } from "@inertiajs/vue3";
//component
import SelectedConfiguration from "@/Pages/components/findYourDealerComponents/SelectedConfiguration.vue";
import SlippyMap from "@/Pages/components/findYourDealerComponents/SlippyMap.vue";

//VARIABLES
const props = defineProps(["data", "countries"]);
const configurationData = props.data;
const countries = props.countries;
const selectedCountry = ref(null);
const selectedCity = ref(null);
const selectedAddress = ref(null);
const formData = ref({
    fullName: "",
    email: "",
    phoneNumber: "",
    privacy: false,
    sendEmail: false,
});
const page = usePage();
const errors = computed(() => {
    return page.props.errors;
});
const successFormSubmit = ref({
    val: false,
    message: "Form succesfully sent!!",
});

//LOGIC

//sets the value of 'cities' according to the selected country.
const computedCities = computed(() => {
    if (selectedCountry.value) {
        const country = countries.find(
            (c) => c.country === selectedCountry.value
        );
        const cities = country ? country.cities : [];
        return cities;
    }
    return [];
});

//sets the value of addresses according to the selected city Obj.
const computedAddresses = computed(() => {
    if (selectedCity.value) {
        const city = computedCities.value.find(
            (c) => c.city === selectedCity.value
        );
        const addresses = city ? city.addresses : [];
        return addresses;
    }
    return [];
});

//if the computedCities array is not anymore included in the current country, it resets selectedCity and selectedAddress variables
watch(selectedCountry, () => {
    if (selectedCity) {
        if (
            !computedCities.value.some(
                (city) => city.city === selectedCity.value
            )
        ) {
            selectedCity.value = null;
            selectedAddress.value = null;
        }
    }
});

//if the computedAddresses array is not anymore included in the current city, it resets the selectedAddress variable
watch(selectedCity, () => {
    if (selectedAddress) {
        if (
            !computedAddresses.value.some(
                (address) => address.address === selectedAddress.value
            )
        ) {
            selectedAddress.value = null;
        }
    }
});

//form handler
const bookAppointment = () => {
    const data = {
        //**NOTE for myself: .value ain't needed in case of non reactive variables.**
        configurationData: configurationData,
        selectedCountry: selectedCountry.value,
        selectedCity: selectedCity.value,
        selectedAddress: selectedAddress.value,
        personalData: formData.value,
    };
    router.post(route("generatePdf"), data, {
        onSuccess: () => {
            formData.value = {
                fullName: "",
                email: "",
                phoneNumber: "",
                privacy: false,
                sendEmail: false,
            };
            successFormSubmit.value.val = true;
        },
    });
};
</script>

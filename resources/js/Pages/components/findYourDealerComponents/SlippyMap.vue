<template>
    <div id="map"></div>
</template>

<script setup>
import { onMounted, watch, ref } from "vue";
import L from "leaflet";
import "leaflet/dist/leaflet.css";
const props = defineProps(["selectedAddress", "computedAddresses"]);
const map = ref(null);
const popup = L.popup();

onMounted(() => {
    //map initialization
    map.value = L.map("map").setView([45.46, 9.18], 13);

    L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
        attribution:
            '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
    }).addTo(map.value);

    L.marker([45.46, 9.18])
        .addTo(map.value)
        .bindPopup("Your Aehra dealer!")
        .openPopup();

    function onMapClick(e) {
        popup
            .setLatLng(e.latlng)
            .setContent("You clicked the map at " + e.latlng.toString())
            .openOn(map.value);
    }

    map.value.on("click", onMapClick);
});
//updates the marks and the view according to the coordinates of the address obj
watch(
    () => props.selectedAddress,
    (newAddress) => {
        if (newAddress) {
            const address = props.computedAddresses.find(
                (a) => a.address === newAddress
            );
            if (address) {
                const { lat, lng } = address;
                map.value.setView([lat, lng], 13);
                L.marker([lat, lng])
                    .addTo(map.value)
                    .bindPopup("Your Aerha dealer!")
                    .openPopup();
            }
        }
    }
);
</script>

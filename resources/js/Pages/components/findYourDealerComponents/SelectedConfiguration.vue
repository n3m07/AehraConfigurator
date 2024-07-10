<template>
    <div class="px-4" v-if="configurationData">
        <h3>You Selected:</h3>
        <!-- 'your selections' box -->
        <div class="border border-black p-4 flex flex-col gap-4">
            <div>
                Model:
                <span class="strong">{{ configurationData.model }}</span>
            </div>
            <div>
                Paint:
                <span class="strong">{{
                    configurationData.exteriorPaint
                }}</span>
            </div>
            <div>
                Color:
                <span class="strong">{{
                    configurationData.interiorColor
                }}</span>
            </div>
            <div>
                Material:
                <span class="strong">{{
                    configurationData.interiorMaterial
                }}</span>
            </div>
            <div>
                Wheels:
                <span class="strong">{{ configurationData.tires }}</span>
            </div>
            <div>
                Brakes:
                <span class="strong">{{ configurationData.brakes }}</span>
            </div>
        </div>
        <!-- back to configurator button -->
        <Link :href="route('configure')">
            <button class="button_white flex w-full mt-4 justify-center">
                back to configurator
            </button>
        </Link>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
const props = defineProps(["configurationData"]);
const configurationData = props.configurationData;
</script>

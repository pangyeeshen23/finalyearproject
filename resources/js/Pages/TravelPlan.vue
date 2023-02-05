<script setup>
import { Head, Link } from "@inertiajs/inertia-vue3";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { computed } from "vue";
import { GoogleMap, Marker } from "vue3-google-map";
import Pagination from "@/Components/Pagination.vue";

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    travelPlans: Object,
});

const populateLatLong = (lat, long) => {
    var location = { lat: parseFloat(lat), lng: parseFloat(long) };
    return location;
};
</script>

<template>
    <Head title="Welcome" />
    <div>
        <GuestLayout :can-login="{ canLogin }" :can-register="{ canRegister }">
            <slot>
                <main>
                    <div class="relative px-6 lg:px-8">
                        <p
                            class="text-2xl font-bold tracking-tight text-gray-900 sm:text-2xl"
                        >
                            Travel Plan
                        </p>
                        <div class="mx-auto py32">
                            <div class="grid grid-cols-4 gap-4 mt-6">
                                <div
                                    class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700"
                                    v-for="item in travelPlans.data"
                                >
                                    <GoogleMap
                                        api-key="AIzaSyBJqBt3CdPyZ_Tt4bTaJxgEuz1mER18_zI"
                                        style="width: 100%; height: 300px"
                                        :center="
                                            populateLatLong(
                                                item.depart_lat,
                                                item.depart_long
                                            )
                                        "
                                        :zoom="15"
                                    >
                                        <Marker
                                            :options="{
                                                position: populateLatLong(
                                                    item.depart_lat,
                                                    item.depart_long
                                                ),
                                            }"
                                        />
                                    </GoogleMap>
                                    <div class="p-5">
                                        <a href="#">
                                            <h5
                                                class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"
                                            >
                                                {{ item.name }}
                                            </h5>
                                        </a>
                                        <p
                                            class="mb-3 font-normal text-gray-700 dark:text-gray-400"
                                        >
                                            {{ item.description }}
                                        </p>
                                        <a
                                            :href="route('travelPlans.details')"
                                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                        >
                                            Details
                                            <svg
                                                aria-hidden="true"
                                                class="w-4 h-4 ml-2 -mr-1"
                                                fill="currentColor"
                                                viewBox="0 0 20 20"
                                                xmlns="http://www.w3.org/2000/svg"
                                            >
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                                    clip-rule="evenodd"
                                                ></path>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <Pagination
                                    class="mt-6"
                                    :links="travelPlans.links"
                                />
                            </div>
                        </div>
                    </div>
                </main>
            </slot>
        </GuestLayout>
    </div>
</template>

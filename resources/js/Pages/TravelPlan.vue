<script setup>
import { Head, Link } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import { ref, watch } from "vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { computed } from "vue";
import { GoogleMap, Marker } from "vue3-google-map";
import Pagination from "@/Components/Pagination.vue";

const filter = {
    search: "",
    price: 0,
    travel_plan_type: 0,
};

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    travelPlans: Object,
});

const searchSubmit = () => {
    console.log(filter);
    Inertia.get(
        "/travel-plan/list",
        {
            search: filter.search,
            price: filter.price,
            travel_plan_type: filter.travel_plan_type,
        },
        {
            preserveState: true,
        }
    );
};

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
                            Travel Plans
                        </p>
                        <div class="flex mt-8">
                            <!-- sidebar -->
                            <div class="flex flex-col w-60 dark:bg-gray-900">
                                <div class="flex items-center justify-center">
                                    <div class="flex items-center">
                                        <span
                                            class="text-2xl font-semibold text-gray-800 dark:text-white"
                                            >Filter By</span
                                        >
                                    </div>
                                </div>

                                <nav class="flex flex-col px-4 mt-10">
                                    <div
                                        class="py-2 text-sm text-gray-700 rounded dark:text-gray-100 dark:bg-gray-800"
                                    >
                                        Price Range
                                        <div>
                                            <select
                                                id="price_range"
                                                v-model="filter.price"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            >
                                                <option value="0" selected>
                                                    Select a price range
                                                </option>
                                                <option value="1">
                                                    RM 1 - RM 25
                                                </option>
                                                <option value="2">
                                                    RM 25 - RM 50
                                                </option>
                                                <option value="3">
                                                    RM 50 - RM 75
                                                </option>
                                                <option value="4">
                                                    RM 75 - RM 100
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div
                                        class="py-2 mt-3 text-sm text-gray-600 rounded dark:text-gray-400"
                                    >
                                        Travel Plan Type

                                        <div>
                                            <select
                                                id="countries"
                                                v-model="
                                                    filter.travel_plan_type
                                                "
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            >
                                                <option value="0" selected>
                                                    Select a type
                                                </option>
                                                <option value="1">
                                                    Default
                                                </option>
                                                <option value="2">
                                                    Only For Student
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div
                                        class="py-2 mt-3 text-sm text-gray-600 rounded dark:text-gray-400"
                                    >
                                        <button
                                            type="button"
                                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                                            @click="searchSubmit()"
                                        >
                                            Filter
                                        </button>
                                    </div>
                                </nav>
                            </div>

                            <!-- the items i want to put in a 3 grid layout !-->
                            <div class="w-full">
                                <form>
                                    <label
                                        for="default-search"
                                        class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white"
                                        >Search</label
                                    >
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none"
                                        >
                                            <svg
                                                aria-hidden="true"
                                                class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                                                ></path>
                                            </svg>
                                        </div>
                                        <input
                                            type="search"
                                            id="default-search"
                                            v-model="filter.search"
                                            class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="Search By Title"
                                            required
                                        />
                                        <button
                                            type="button"
                                            class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                            @click="searchSubmit()"
                                        >
                                            Search
                                        </button>
                                    </div>
                                </form>

                                <div
                                    class="p-4 grid grid-cols-4 gap-4 mt-6 bg-gray-50 w-full"
                                    v-if="
                                        travelPlans.data &&
                                        travelPlans.data.length > 0
                                    "
                                >
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
                                                :href="
                                                    route(
                                                        'travelPlans.details',
                                                        {
                                                            id: item.id,
                                                        }
                                                    )
                                                "
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
                                <div
                                    class="p-4 mt-6 bg-gray-50 w-full text-center"
                                    v-else
                                >
                                    <p>No Travel Plan is Available</p>
                                </div>
                                <div>
                                    <Pagination
                                        class="mt-6"
                                        :links="travelPlans.links"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </slot>
        </GuestLayout>
    </div>
</template>

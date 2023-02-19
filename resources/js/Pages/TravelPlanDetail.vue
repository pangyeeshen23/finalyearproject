<script setup>
import { Head, Link } from "@inertiajs/inertia-vue3";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { GoogleMap, Marker } from "vue3-google-map";
import Table from "@/Components/Table.vue";

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    detail: Object,
});

const populateLatLong = (lat, long) => {
    var location = { lat: parseFloat(lat), lng: parseFloat(long) };
    return location;
};

const columns = [
    {
        display: "User",
        data: "username",
    },
    {
        display: "Joined Date",
        data: "created_date",
    },
    {
        display: "Rate Given",
        data: "rate",
    },
];

const rows = [
    {
        username: "demo",
        created_date: "19/2/2023",
        rate: "0",
    },
    {
        username: "demo2",
        created_date: "17/2/2023",
        rate: "0",
    },
    {
        username: "demo5",
        created_date: "5/2/2023",
        rate: "0",
    },
];
</script>

<template>
    <Head title="Welcome" />
    <div>
        <GuestLayout :can-login="{ canLogin }" :can-register="{ canRegister }">
            <slot>
                <main>
                    <div class="relative px-6 lg:px-8">
                        <div class="flex flex-row w-full">
                            <div class="flex flex-col basis-5/6">
                                <p
                                    class="text-2xl font-bold tracking-tight text-gray-900 sm:text-2xl"
                                >
                                    Travel Plan - {{ detail.name }}
                                </p>
                            </div>
                            <div class="flex flex-col basis-1/6">
                                <a
                                    @click="joinTravelPlan()"
                                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                >
                                    Join Travel Plan
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
                        <div class="grid grid-cols-2 gap-4">
                            <div class="flex mt-8">
                                <!-- the items i want to put in a 3 grid layout !-->
                                <div class="w-full">
                                    <div
                                        class="border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700"
                                    >
                                        <GoogleMap
                                            api-key="AIzaSyBJqBt3CdPyZ_Tt4bTaJxgEuz1mER18_zI"
                                            style="width: 100%; height: 300px"
                                            :center="
                                                populateLatLong(
                                                    detail.depart_lat,
                                                    detail.depart_long
                                                )
                                            "
                                            :zoom="15"
                                        >
                                            <Marker
                                                :options="{
                                                    position: populateLatLong(
                                                        detail.depart_lat,
                                                        detail.depart_long
                                                    ),
                                                }"
                                            />
                                        </GoogleMap>
                                        <p
                                            class="text-2xl font-bold tracking-tight text-gray-900 sm:text-2xl p-5"
                                        ></p>

                                        <div class="p-5">
                                            <h5
                                                class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"
                                            >
                                                Depart Location
                                            </h5>
                                            <p
                                                class="text-2xl font-bold tracking-tight text-gray-900 sm:text-2xl"
                                            >
                                                Travel Plan - {{ detail.name }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="flex mt-8">
                                <!-- the items i want to put in a 3 grid layout !-->
                                <div class="w-full">
                                    <div
                                        class="border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700"
                                    >
                                        <GoogleMap
                                            api-key="AIzaSyBJqBt3CdPyZ_Tt4bTaJxgEuz1mER18_zI"
                                            style="width: 100%; height: 300px"
                                            :center="
                                                populateLatLong(
                                                    detail.destination_lat,
                                                    detail.destination_long
                                                )
                                            "
                                            :zoom="15"
                                        >
                                            <Marker
                                                :options="{
                                                    position: populateLatLong(
                                                        detail.destination_lat,
                                                        detail.destination_long
                                                    ),
                                                }"
                                            />
                                        </GoogleMap>
                                        <p
                                            class="text-2xl font-bold tracking-tight text-gray-900 sm:text-2xl p-5"
                                        ></p>

                                        <div class="p-5">
                                            <h5
                                                class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"
                                            >
                                                Destination Location
                                            </h5>
                                            <p
                                                class="text-2xl font-bold tracking-tight text-gray-900 sm:text-2xl"
                                            >
                                                Travel Plan - {{ detail.name }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex mt-8">
                            <!-- the items i want to put in a 3 grid layout !-->
                            <div class="w-full">
                                <div
                                    class="border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700"
                                >
                                    <div class="p-5">
                                        <h5
                                            class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"
                                        >
                                            Details
                                        </h5>
                                        <div class="grid grid-cols-2 gap-4">
                                            <p
                                                class="text-lg font-bold tracking-tight text-gray-900 sm:text-lg"
                                            >
                                                Name : {{ detail.name }}
                                            </p>
                                            <p
                                                class="text-lg font-bold tracking-tight text-gray-900 sm:text-lg"
                                            >
                                                Meeting Point :
                                                {{ detail.meeting_point }}
                                            </p>
                                        </div>
                                        <div class="grid grid-cols-2 gap-4">
                                            <p
                                                class="text-lg font-bold tracking-tight text-gray-900 sm:text-lg"
                                            >
                                                Passenger :
                                                {{ detail.num_passengers }}
                                            </p>
                                            <p
                                                class="text-lg font-bold tracking-tight text-gray-900 sm:text-lg"
                                            >
                                                Fees : RM
                                                {{ detail.fees }} /Person
                                            </p>
                                        </div>
                                        <p
                                            class="text-lg font-bold tracking-tight text-gray-900 sm:text-lg"
                                        >
                                            Description :
                                        </p>
                                        <p
                                            class="text-lg font-light tracking-tight text-gray-900 sm:text-lg"
                                        >
                                            {{ detail.description }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex mt-8">
                            <!-- the items i want to put in a 3 grid layout !-->
                            <div class="w-full">
                                <div
                                    class="border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700"
                                >
                                    <div class="p-5">
                                        <h5
                                            class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"
                                        >
                                            Joined Passenger
                                        </h5>
                                        <div
                                            class="relative overflow-x-auto shadow-md sm:rounded-lg"
                                        >
                                            <Table
                                                :columns="columns"
                                                :rows="rows"
                                            ></Table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </slot>
        </GuestLayout>
    </div>
</template>

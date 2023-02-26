<script setup>
import { Head, Link } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import { ref, watch } from "vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { computed } from "vue";
import { GoogleMap, Marker } from "vue3-google-map";
import Pagination from "@/Components/Pagination.vue";
import Rating from "@/Components/Rating.vue";
import Table from "@/Components/Table.vue";

const filter = {
    search: "",
    rateSortBy: 0,
};

var props = defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    driver: Object,
    totalCompletedTravelPLans: Number,
    totalTravelPlans: Number,
    totalRatingReceived: Number,
});

const columns = [
    {
        display: "Travel Plan",
        data: "name",
    },
    {
        display: "Depart Location",
        data: "depart_name",
    },
    {
        display: "Destination Location",
        data: "destination_name",
    },
    {
        display: "Fees",
        data: "fees",
    },
    {
        display: "Only For Student",
        data: "is_student",
    },
    {
        display: "Created At",
        data: "created_date",
    },
    {
        display: "Action",
        format: "navigation",
        link: "/travel-plan/details?id=",
        data: "id",
    },
];

const populateImage = (imag_link) => {
    var link = "/storage/admin/" + imag_link;
    return link;
};

const formatTravelPlans = () => {
    var rows = _.map(props.driver.travel_plans, function (n) {
        return {
            id: n.id,
            name: n.name,
            depart_name: n.depart_name,
            destination_name: n.destination_name,
            fees: n.fees,
            is_student: n.is_student ? "True" : "False",
            created_date: n.created_at
                ? new Date(n.created_at).toDateString()
                : "No Date",
        };
    });
    return rows;
};
</script>

<template>
    <Head title="Welcome" />
    <div>
        <GuestLayout :can-login="{ canLogin }" :can-register="{ canRegister }">
            <slot>
                <main>
                    <div class="relative px-6 py-6 lg:px-8 bg-gray-50 rounded">
                        <div class="w-full">
                            <div>
                                <p
                                    class="text-2xl font-bold tracking-tight text-gray-900 sm:text-2xl"
                                >
                                    Driver - {{ driver.name }}
                                </p>
                            </div>
                        </div>
                        <div
                            class="flex flex-row pt-5 space-x-4 items-stretch w-full"
                        >
                            <div class="flex flex-col basis-2/12">
                                <!-- the items i want to put in a 3 grid layout !-->
                                <div class="w-full">
                                    <div
                                        class="border border-gray-200 bg-white rounded-lg shadow dark:bg-gray-800 dark:border-gray-700"
                                    >
                                        <div
                                            class="flex flex-col items-center pb-10 pt-2"
                                        >
                                            <img
                                                class="w-24 h-24 mb-3 rounded-full shadow-lg"
                                                :src="
                                                    populateImage(driver.avatar)
                                                "
                                                alt="Bonnie image"
                                            />
                                            <h5
                                                class="mb-1 text-xl font-medium text-gray-900 dark:text-white"
                                            >
                                                {{ driver.name }}
                                            </h5>
                                            <span
                                                class="text-sm text-gray-500 dark:text-gray-400"
                                            >
                                                {{ driver.description }}
                                            </span>
                                            <Rating
                                                :rate="driver.rate"
                                            ></Rating>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="flex flex-col basis-10/12">
                                <!-- the items i want to put in a 3 grid layout !-->
                                <div class="w-full h-full">
                                    <div
                                        class="border border-gray-200 bg-white rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 h-full"
                                    >
                                        <div
                                            class="grid grid-cols-3 gap-4 h-full"
                                        >
                                            <div class="text-center h-full">
                                                <div
                                                    class="flex flex-col items-center pb-5 pt-2"
                                                >
                                                    <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 24 24"
                                                        fill="currentColor"
                                                        class="w-20 h-20 fill-blue-500"
                                                    >
                                                        <path
                                                            fillRule="evenodd"
                                                            d="M1.5 7.125c0-1.036.84-1.875 1.875-1.875h6c1.036 0 1.875.84 1.875 1.875v3.75c0 1.036-.84 1.875-1.875 1.875h-6A1.875 1.875 0 011.5 10.875v-3.75zm12 1.5c0-1.036.84-1.875 1.875-1.875h5.25c1.035 0 1.875.84 1.875 1.875v8.25c0 1.035-.84 1.875-1.875 1.875h-5.25a1.875 1.875 0 01-1.875-1.875v-8.25zM3 16.125c0-1.036.84-1.875 1.875-1.875h5.25c1.036 0 1.875.84 1.875 1.875v2.25c0 1.035-.84 1.875-1.875 1.875h-5.25A1.875 1.875 0 013 18.375v-2.25z"
                                                            clipRule="evenodd"
                                                        />
                                                    </svg>
                                                </div>
                                                <p class="font-bold">
                                                    Total Travel Plans
                                                </p>
                                                <p
                                                    class="font-bold text-2xl mt-2"
                                                >
                                                    {{ totalTravelPlans }}
                                                </p>
                                            </div>
                                            <div class="text-center h-full">
                                                <div
                                                    class="flex flex-col items-center pb-5 pt-2"
                                                >
                                                    <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 24 24"
                                                        fill="currentColor"
                                                        class="w-20 h-20 fill-green-500"
                                                    >
                                                        <path
                                                            fillRule="evenodd"
                                                            d="M8.603 3.799A4.49 4.49 0 0112 2.25c1.357 0 2.573.6 3.397 1.549a4.49 4.49 0 013.498 1.307 4.491 4.491 0 011.307 3.497A4.49 4.49 0 0121.75 12a4.49 4.49 0 01-1.549 3.397 4.491 4.491 0 01-1.307 3.497 4.491 4.491 0 01-3.497 1.307A4.49 4.49 0 0112 21.75a4.49 4.49 0 01-3.397-1.549 4.49 4.49 0 01-3.498-1.306 4.491 4.491 0 01-1.307-3.498A4.49 4.49 0 012.25 12c0-1.357.6-2.573 1.549-3.397a4.49 4.49 0 011.307-3.497 4.49 4.49 0 013.497-1.307zm7.007 6.387a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z"
                                                            clipRule="evenodd"
                                                        />
                                                    </svg>
                                                </div>
                                                <p class="font-bold">
                                                    Total Completed Travel Plans
                                                </p>
                                                <p
                                                    class="font-bold text-2xl mt-2"
                                                >
                                                    {{
                                                        totalCompletedTravelPLans
                                                    }}
                                                </p>
                                            </div>
                                            <div class="text-center h-full">
                                                <div
                                                    class="flex flex-col items-center pb-5 pt-2"
                                                >
                                                    <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 24 24"
                                                        fill="currentColor"
                                                        class="w-20 h-20 fill-yellow-500"
                                                    >
                                                        <path
                                                            fillRule="evenodd"
                                                            d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z"
                                                            clipRule="evenodd"
                                                        />
                                                    </svg>
                                                </div>
                                                <p class="font-bold">
                                                    Total Rate Received
                                                </p>
                                                <p
                                                    class="font-bold text-2xl mt-2"
                                                >
                                                    {{ totalRatingReceived }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex mt-8">
                            <div class="w-full">
                                <div
                                    class="border border-gray-200 bg-white rounded-lg shadow dark:bg-gray-800 dark:border-gray-700"
                                >
                                    <div class="p-5">
                                        <h5
                                            class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"
                                        >
                                            Details
                                        </h5>
                                        <div>
                                            <p
                                                class="text-lg font-bold tracking-tight text-gray-900 sm:text-lg"
                                            >
                                                Age : {{ driver.age }}
                                            </p>
                                        </div>
                                        <div>
                                            <p
                                                class="text-lg font-bold tracking-tight text-gray-900 sm:text-lg"
                                            >
                                                Email Address :
                                                {{ driver.email_address }}
                                            </p>
                                        </div>
                                        <div>
                                            <p
                                                class="text-lg font-bold tracking-tight text-gray-900 sm:text-lg"
                                            >
                                                Birthday :
                                                {{ driver.birthday }}
                                            </p>
                                        </div>
                                        <div>
                                            <p
                                                class="text-lg font-bold tracking-tight text-gray-900 sm:text-lg"
                                            >
                                                Phone Number :
                                                {{ driver.phone_number }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex mt-8">
                            <div class="w-full">
                                <div
                                    class="border border-gray-200 bg-white rounded-lg shadow dark:bg-gray-800 dark:border-gray-700"
                                >
                                    <div class="p-5">
                                        <h5
                                            class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"
                                        >
                                            Active Travel Plans
                                        </h5>
                                        <div
                                            class="relative overflow-x-auto shadow-md sm:rounded-lg"
                                        >
                                            <Table
                                                :columns="columns"
                                                :rows="formatTravelPlans()"
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

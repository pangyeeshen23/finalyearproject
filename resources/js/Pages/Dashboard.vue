<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/inertia-vue3";
import Table from "@/Components/Table.vue";

var props = defineProps({
    totalPlanCount: Number,
    rateGivenCount: Number,
    totalSpending: Number,
    historyTravelPlans: Number,
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
        display: "Created At",
        data: "created_date",
    },
    {
        display: "Action",
        format: "rate",
        buttonText: "Rate",
        data: "id",
    },
];

const formatTravelPlans = () => {
    var rows = _.map(props.historyTravelPlans, function (n) {
        return {
            id: n.id,
            name: n.travel_plan?.name,
            depart_name: n.travel_plan?.depart_name,
            destination_name: n.travel_plan?.destination_name,
            fees: n.travel_plan?.fees,
            rate: n.rate,
            created_date: n.travel_plan?.created_at
                ? new Date(n.travel_plan?.created_at).toDateString()
                : "No Date",
        };
    });
    return rows;
};

const showRateModel = () => {
    console.log("Hello");
};
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-5">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4"
                >
                    <h2
                        class="font-semibold text-xl text-gray-800 leading-tight"
                    >
                        Analytics
                    </h2>
                    <div class="grid grid-cols-3 gap-4 h-full">
                        <div class="text-center h-full">
                            <div class="flex flex-col items-center pb-5 pt-2">
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
                            <p class="font-bold">Total joined Travel Plans</p>
                            <p class="font-bold text-2xl mt-2">
                                {{ totalPlanCount }}
                            </p>
                        </div>
                        <div class="text-center h-full">
                            <div class="flex flex-col items-center pb-5 pt-2">
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
                            <p class="font-bold">Total Rate Given</p>
                            <p class="font-bold text-2xl mt-2">
                                {{ rateGivenCount }}
                            </p>
                        </div>
                        <div class="text-center h-full">
                            <div class="flex flex-col items-center pb-5 pt-2">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24"
                                    stroke="fill-white-500"
                                    class="w-20 h-20 fill-green-500"
                                >
                                    <path
                                        d="M12 7.5a2.25 2.25 0 100 4.5 2.25 2.25 0 000-4.5z"
                                    />
                                    <path
                                        fillRule="evenodd"
                                        d="M1.5 4.875C1.5 3.839 2.34 3 3.375 3h17.25c1.035 0 1.875.84 1.875 1.875v9.75c0 1.036-.84 1.875-1.875 1.875H3.375A1.875 1.875 0 011.5 14.625v-9.75zM8.25 9.75a3.75 3.75 0 117.5 0 3.75 3.75 0 01-7.5 0zM18.75 9a.75.75 0 00-.75.75v.008c0 .414.336.75.75.75h.008a.75.75 0 00.75-.75V9.75a.75.75 0 00-.75-.75h-.008zM4.5 9.75A.75.75 0 015.25 9h.008a.75.75 0 01.75.75v.008a.75.75 0 01-.75.75H5.25a.75.75 0 01-.75-.75V9.75z"
                                        clipRule="evenodd"
                                    />
                                    <path
                                        d="M2.25 18a.75.75 0 000 1.5c5.4 0 10.63.722 15.6 2.075 1.19.324 2.4-.558 2.4-1.82V18.75a.75.75 0 00-.75-.75H2.25z"
                                    />
                                </svg>
                            </div>
                            <p class="font-bold">Total Spending</p>
                            <p class="font-bold text-2xl mt-2">
                                {{ totalSpending }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="py-5">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4"
                >
                    <h2
                        class="font-semibold text-xl text-gray-800 leading-tight mb-5"
                    >
                        History List
                    </h2>
                    <div
                        class="relative overflow-x-auto shadow-md sm:rounded-lg"
                    >
                        <Table
                            :columns="columns"
                            :rows="formatTravelPlans()"
                            @buttonClick="showRateModel()"
                        ></Table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

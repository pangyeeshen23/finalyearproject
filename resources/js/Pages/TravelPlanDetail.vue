<script setup>
import { Head, Link, usePage } from "@inertiajs/inertia-vue3";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { GoogleMap, Marker } from "vue3-google-map";
import Table from "@/Components/Table.vue";
import Modal from "@/Components/Modal.vue";
import LoginModal from "@/Components/LoginModal.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import { nextTick, ref } from "vue";
import axios from "axios";
import _ from "lodash";

var props = defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    detail: Object,
    joinRecord: Object,
    allPassenger: Array,
});

const showLogin = ref(false);
const showAlert = ref(false);
const disabledButton = ref(false);

var errorMsg = ref("");
var showError = ref(false);

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

const formatPassengerRows = () => {
    console.log(props.driver);
    var rows = _.map(props.allPassenger, function (n) {
        return {
            username: n.user?.name,
            created_date: n.created_at
                ? new Date(n.created_at).toDateString()
                : "No Date",
            rate: n.rate,
        };
    });
    return rows;
};

const checkJoinStatus = () => {
    if (props.joinRecord) return true;
    else return false;
};

const buttonClass = () => {
    var status = checkJoinStatus();
    if (status)
        return "px-3 py-2 text-sm font-medium text-center text-white bg-green-700 rounded-lg focus:ring-4 focus:outline-none focus:ring-blue-300 ";
    else
        return "px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 cursor-pointer";
};

const buttonText = () => {
    var status = checkJoinStatus();
    if (status) return "Joined";
    else return "Join Travel Plan";
};

const populateImage = (imag_link) => {
    var link = "/storage/admin/" + imag_link;
    return link;
};

const joinTravelPlan = (user) => {
    disabledButton.value = true;
    if (user) acceptJoinTravelPlan(user);
    else showLogin.value = true;
};

const acceptJoinTravelPlan = (user) => {
    axios
        .post("/travel-plan/join", {
            travel_plan_id: props.detail.id,
            user_id: user.id,
        })
        .then(() => {
            location.reload();
            disabledButton.value = false;
        })
        .catch(function (error) {
            var res = error.response.data;
            errorMsg.value = res.exceptions;
            showError.value = true;
            console.log(showError);
        });
};

const closeLoginModal = () => {
    showLogin.value = false;
};

const populateRedirectLink = () => {
    return "/travel-plan/details?id=" + props.detail.id;
};
</script>

<template>
    <Head title="Welcome" />
    <div>
        <GuestLayout :can-login="{ canLogin }" :can-register="{ canRegister }">
            <slot>
                <main>
                    <div class="relative px-6 py-6 lg:px-8 bg-gray-50 rounded">
                        <div class="flex flex-row w-full">
                            <div class="flex flex-col basis-11/12">
                                <p
                                    class="text-2xl font-bold tracking-tight text-gray-900 sm:text-2xl"
                                >
                                    Travel Plan - {{ detail.name }}
                                </p>
                            </div>
                            <div class="flex flex-col basis-1/12">
                                <button
                                    :disabled="checkJoinStatus()"
                                    @click="
                                        joinTravelPlan($page.props.auth.user)
                                    "
                                    :class="buttonClass()"
                                >
                                    <span class="inline-flex">
                                        {{ buttonText() }}
                                        <svg
                                            v-if="!checkJoinStatus()"
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
                                    </span>
                                </button>
                            </div>
                        </div>
                        <div
                            v-if="checkJoinStatus()"
                            class="p-4 mt-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                            role="alert"
                        >
                            <span class="font-medium">
                                Successfully Joined Travel Plan!
                            </span>
                        </div>
                        <div
                            v-if="showError"
                            class="p-4 mt-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                            role="alert"
                        >
                            <span class="font-medium">
                                {{ errorMsg }}
                            </span>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="flex mt-8">
                                <!-- the items i want to put in a 3 grid layout !-->
                                <div class="w-full">
                                    <div
                                        class="border border-gray-200 bg-white rounded-lg shadow dark:bg-gray-800 dark:border-gray-700"
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
                                                {{ detail.depart_name }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="flex mt-8">
                                <!-- the items i want to put in a 3 grid layout !-->
                                <div class="w-full">
                                    <div
                                        class="border border-gray-200 bg-white rounded-lg shadow dark:bg-gray-800 dark:border-gray-700"
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
                                                {{ detail.destination_name }}
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
                                    class="border border-gray-200 bg-white rounded-lg shadow dark:bg-gray-800 dark:border-gray-700"
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
                                        <hr class="mt-4 mb-4" />
                                        <p
                                            class="text-2xl font-bold tracking-tight text-gray-900 sm:text-2xl"
                                        >
                                            Driver
                                            <a
                                                :href="
                                                    route('driver.details', {
                                                        id: props.detail
                                                            .creator_id,
                                                    })
                                                "
                                                class="float-right"
                                            >
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
                                        </p>
                                        <div class="w-1/2 p-2">
                                            <div class="flex flex-row gap-1">
                                                <div
                                                    class="flex flex-col basis-1/4 items-center border-r-2"
                                                >
                                                    <img
                                                        class="w-24 h-24 mb-3 rounded-full shadow-lg"
                                                        :src="
                                                            populateImage(
                                                                detail.creator
                                                                    .avatar
                                                            )
                                                        "
                                                        alt="Driver Profile"
                                                    />
                                                </div>
                                                <div
                                                    class="flex flex-col basis-3/4 gap-1"
                                                >
                                                    <p
                                                        class="text-lg font-bold tracking-tight text-gray-900 sm:text-lg"
                                                    >
                                                        Name :
                                                        {{
                                                            detail.creator.name
                                                        }}
                                                    </p>
                                                    <p
                                                        class="text-lg font-bold tracking-tight text-gray-900 sm:text-lg"
                                                    >
                                                        Email Address :
                                                        {{
                                                            detail.creator
                                                                .email_address
                                                        }}
                                                    </p>
                                                    <p
                                                        class="text-lg font-bold tracking-tight text-gray-900 sm:text-lg"
                                                    >
                                                        Phone Number :
                                                        {{
                                                            detail.creator
                                                                .phone_number
                                                        }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex mt-8">
                            <!-- the items i want to put in a 3 grid layout !-->
                            <div class="w-full">
                                <div
                                    class="border border-gray-200 bg-white rounded-lg shadow dark:bg-gray-800 dark:border-gray-700"
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
                                                :rows="formatPassengerRows()"
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
    <LoginModal
        :show="showLogin"
        :can-register="{ canRegister }"
        :redirect-link="populateRedirectLink()"
        @close="closeLoginModal()"
    >
    </LoginModal>
</template>

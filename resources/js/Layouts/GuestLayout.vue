<script setup>
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import { Link } from "@inertiajs/inertia-vue3";

const props = defineProps(["canLogin", "canRegister"]);

const populateActiveStatus = (href) => {
    if (location.pathname.substr(1) == href)
        return "block py-2 pl-3 pr-4 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 dark:text-white";
    else
        return "block py-2 pl-3 pr-4 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent";
};
</script>

<template>
    <div>
        <div>
            <nav
                class="bg-white border-gray-200 px-2 sm:px-4 py-2.5 rounded dark:bg-gray-900 shadow-md"
            >
                <div
                    class="container flex flex-wrap items-center justify-between mx-auto"
                >
                    <a :href="route('home')" class="flex items-center">
                        <img
                            src="/logo/EzCarpool.png"
                            class="h-6 mr-3 sm:h-9"
                            alt="Flowbite Logo"
                        />
                        <span
                            class="self-center text-xl font-semibold whitespace-nowrap dark:text-white"
                            >EZ Carpool</span
                        >
                    </a>
                    <button
                        data-collapse-toggle="navbar-default"
                        type="button"
                        class="inline-flex items-center p-2 ml-3 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                        aria-controls="navbar-default"
                        aria-expanded="false"
                    >
                        <span class="sr-only">Open main menu</span>
                        <svg
                            class="w-6 h-6"
                            aria-hidden="true"
                            fill="currentColor"
                            viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                clip-rule="evenodd"
                            ></path>
                        </svg>
                    </button>
                    <div
                        class="hidden w-full md:block md:w-auto"
                        id="navbar-default"
                    >
                        <ul
                            class="flex flex-col p-4 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700"
                        >
                            <li>
                                <a
                                    :href="route('home')"
                                    :class="populateActiveStatus('')"
                                    aria-current="page"
                                    >Home</a
                                >
                            </li>
                            <li>
                                <a
                                    :href="route('travelPlans.list')"
                                    :class="
                                        populateActiveStatus('travel-plan/list')
                                    "
                                    >Travel Plan</a
                                >
                            </li>
                            <li>
                                <a
                                    :href="route('driver.list')"
                                    :class="populateActiveStatus('driver/list')"
                                    >Driver</a
                                >
                            </li>
                            <li v-if="$page.props.auth.user">
                                <a
                                    :href="route('dashboard')"
                                    :class="populateActiveStatus('dashboard')"
                                    >Dashboard</a
                                >
                            </li>
                            <li v-if="canLogin">
                                <a
                                    :href="route('login')"
                                    :class="populateActiveStatus('login')"
                                    >Login</a
                                >
                            </li>
                            <li v-if="canLogin">
                                <a
                                    :href="route('register')"
                                    :class="populateActiveStatus('register')"
                                    >Register</a
                                >
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>

        <div class="mt-6 px-6 py-4 bg-white overflow-hidden sm:rounded-lg">
            <slot />
        </div>
    </div>
</template>

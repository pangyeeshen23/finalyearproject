<script setup>
import { Head, Link } from "@inertiajs/inertia-vue3";
import GuestLayout from "@/Layouts/GuestLayout.vue";

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});
</script>

<template>
    <Head title="Welcome" />
    <div>
        <GuestLayout :can-login="{ canLogin }" :can-register="{ canRegister }">
            <slot>
                <main>
                    <div class="relative px-6 lg:px-8">
                        <div class="mx-auto max-w-2xl py-32 sm:py-48 lg:py-56">
                            <div class="text-center">
                                <h1
                                    class="text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl"
                                >
                                    The Carpool System that propose innovative
                                    and creative solutions
                                </h1>
                                <p class="mt-6 text-lg leading-8 text-gray-600">
                                    This is only a final year project, please do
                                    not register as an user in this website
                                </p>
                                <div
                                    class="mt-10 flex items-center justify-center gap-x-6"
                                >
                                    <a
                                        :href="route('travelPlan')"
                                        class="rounded-md bg-indigo-600 px-3.5 py-1.5 text-base font-semibold leading-7 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                                        >Join Travel Now</a
                                    >
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr
                        class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700"
                    />
                    <div class="relative px-6 lg:px-8">
                        <div class="mx-auto py32">
                            <div
                                class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700"
                            >
                                <a href="#">
                                    <img
                                        class="rounded-t-lg"
                                        src="/docs/images/blog/image-1.jpg"
                                        alt=""
                                    />
                                </a>
                                <div class="p-5">
                                    <a href="#">
                                        <h5
                                            class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"
                                        >
                                            Noteworthy technology acquisitions
                                            2021
                                        </h5>
                                    </a>
                                    <p
                                        class="mb-3 font-normal text-gray-700 dark:text-gray-400"
                                    >
                                        Here are the biggest enterprise
                                        technology acquisitions of 2021 so far,
                                        in reverse chronological order.
                                    </p>
                                    <a
                                        href="#"
                                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                    >
                                        Read more
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
                    </div>
                </main>
            </slot>
        </GuestLayout>
    </div>
</template>

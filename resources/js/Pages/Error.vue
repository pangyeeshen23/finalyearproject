<script setup>
import { Head, Link } from "@inertiajs/inertia-vue3";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import Pagination from "@/Components/Pagination.vue";
import Rating from "@/Components/Rating.vue";
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
                            Drivers
                        </p>
                    </div>
                </main>
            </slot>
        </GuestLayout>
    </div>
</template>

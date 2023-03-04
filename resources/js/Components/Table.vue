<script setup>
import Rating from "@/Components/Rating.vue";

const props = defineProps({
    columns: Array,
    rows: Array,
});

const emit = defineEmits(["buttonClick", "updateRate"]);

const emitAction = (action) => {
    emit(action);
};

const updateRate = (rate) => {
    emit("updateRate", rate);
};
</script>

<template>
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead
            class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
        >
            <tr>
                <th v-for="column in columns" scope="col" class="px-6 py-3">
                    {{ column.display }}
                </th>
            </tr>
        </thead>
        <tbody>
            <tr
                v-for="row in rows"
                class="bg-white border-b dark:bg-gray-900 dark:border-gray-700"
            >
                <td v-for="column in columns" class="px-6 py-4">
                    <a
                        v-if="column.format == 'navigation'"
                        :href="column.link + row[column.data]"
                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    >
                        Details
                    </a>
                    <Rating
                        v-else-if="column.format == 'rate'"
                        :rate="row[column.data]"
                        :clickable="column.clickable"
                        :row.sync="row"
                        @updateRate="updateRate"
                    ></Rating>
                    <p v-else-if="!column.format">{{ row[column.data] }}</p>
                </td>
            </tr>
        </tbody>
    </table>
</template>

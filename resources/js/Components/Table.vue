<script setup>
const props = defineProps({
    columns: Array,
    rows: Array,
});

console.log(props.columns);
console.log(props.rows[0][props.columns.data]);
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
                    {{ row[column.data] }}
                </td>
            </tr>
        </tbody>
    </table>
</template>

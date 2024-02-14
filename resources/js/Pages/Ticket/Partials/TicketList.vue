<script setup>

import PrimaryButton from "@/Components/PrimaryButton.vue";
import {router} from "@inertiajs/vue3";
import {onMounted} from "vue";

const props = defineProps({
    tickets: {
        type: [Object, Array],
        required: true
    }
})

onMounted(() => {
    console.log(props.tickets)
})

</script>

<template>
<table class="w-full">
    <thead>
        <tr>
            <th>Адрес</th>
            <th>Состояние</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    <tr v-for="ticket in tickets">
        <td>{{ ticket.data.address }}</td>
        <td>{{ ticket.data.label }}</td>
        <td>
            <PrimaryButton @click="router.visit(route('ticket.show', ticket.data.id))">
                show
            </PrimaryButton>
        </td>
    </tr>
    </tbody>
</table>
</template>

<style scoped>

</style>

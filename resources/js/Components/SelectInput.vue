<script setup>
import {ref} from "vue";

defineProps({
    modelValue: {
        type: String,
        required: true,
    },
    items: {
        type: [Array, Object],
        required: true
    },
    selected: {
        type: [String, Number]
    },
    placeholder: String
});

defineEmits(['update:modelValue']);

const input = ref(null);
</script>

<template>

    <select
        :value="modelValue"
        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
        @input="$emit('update:modelValue', $event.target.value)"
    >
        <option
            v-for="(item, index) in items"
            :value="index"
        >
            {{ item }}
        </option>
    </select>
</template>

<style scoped>

</style>

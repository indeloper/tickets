<script setup>

import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import SelectInput from "@/Components/SelectInput.vue";
import TextAreaInput from "@/Components/TextAreaInput.vue";

const props = defineProps({
    form: {
        type: [Object, Array],
        required: true
    },
    labels: {
        type: [Object, Array],
        required: true
    },
    payers: [Object, Array],
    abilities: [Object, Array]
})
</script>

<template>
    <div class="mt-4">
        <InputLabel value="Адрес объекта"/>
        <TextInput
            class="mt-1 block w-full"
            placeholder="Адрес объекта"
            v-model="form.address"
        />
        <InputError :message="form.errors.address"/>
    </div>
    <div class="mt-4">
        <InputLabel value="Арендатор"/>
        <TextInput
            class="mt-1 block w-full"
            placeholder="Арендатор"
            v-model="form.tenant"
        />
        <InputError :message="form.errors.tenant"/>
    </div>
    <div class="mt-4">
        <InputLabel value="Состояние"/>
        <SelectInput
            class="mt-1 block w-full"
            placeholder="Состояние"
            :items="labels"
            v-model="form.label"
        />
        <InputError :message="form.errors.condition"/>
    </div>
    <div class="mt-4">
        <InputLabel value="Описание"/>
        <TextAreaInput
            class="mt-1 block w-full"
            placeholder="Описание"
            v-model="form.description"
        />
        <InputError :message="form.errors.description"/>
    </div>
    <div v-if="abilities?.budget.allowed" class="mt-4">
        <InputLabel value="Плательщик"/>
        <SelectInput
            class="mt-1 block w-full"
            placeholder="Плательщик"
            :items="payers"
            v-model="form.payer"
        />
        <InputError :message="form.errors.payer"/>
    </div>
</template>

<style scoped>

</style>

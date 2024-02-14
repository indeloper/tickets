<script setup>
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import SelectInput from "@/Components/SelectInput.vue";

const props = defineProps({
    form: [Object, Array],
    roles: [Object, Array]
})

</script>

<template>
    <div class="mt-4">
        <InputLabel value="Фамилия"/>
        <TextInput
            class="mt-1 block w-full"
            placeholder="Фамилия"
            v-model="form.last_name"
            required
        />
        <InputError :message="form.errors.last_name"/>
    </div>
    <div class="mt-4">
        <InputLabel value="Имя"/>
        <TextInput
            class="mt-1 block w-full"
            placeholder="Имя"
            v-model="form.first_name"
            required
        />
        <InputError :message="form.errors.first_name"/>
    </div>
    <div class="mt-4">
        <InputLabel value="Отчество"/>
        <TextInput
            class="mt-1 block w-full"
            placeholder="Отчество"
            v-model="form.second_name"
        />
        <InputError :message="form.errors.second_name"/>
    </div>
    <div class="mt-4">
        <InputLabel value="Email"/>
        <TextInput
            type="email"
            class="mt-1 block w-full"
            placeholder="Email"
            v-model="form.email"
            required
        />
        <InputError :message="form.errors.email"/>
    </div>
    <div class="mt-4">
        <InputLabel value="Роль"/>
        <SelectInput
            :items="roles"
            v-model="form.role"
        />
        <InputError :message="form.errors.role"/>
    </div>
</template>

<style scoped>

</style>

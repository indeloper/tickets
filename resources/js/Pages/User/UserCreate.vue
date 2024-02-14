<script setup>

import {router, useForm} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import Icon from "@/Components/Icon.vue";
import UserForm from "@/Pages/User/Partials/UserForm.vue";
import {Head} from '@inertiajs/vue3';
import PrimaryButton from "@/Components/PrimaryButton.vue";

const props = defineProps({
    roles: [Array, Object]
})

const form = useForm({
    first_name: null,
    second_name: null,
    last_name: null,
    email: null,
    role: null
})

</script>

<template>
    <Head title="Пользователи"/>

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between content-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight self-center">Создание пользователя</h2>
                <SecondaryButton @click="router.visit(route('user.index'))">
                    <Icon name="list"/>
                </SecondaryButton>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <form
                        @submit.prevent="form.post(route('user.store'))"
                        class="max-w-xl"
                    >
                        <section>

                            <header>
                                <h2 class="text-lg font-medium text-gray-900">Данные нового пользователя</h2>

                                <p class="mt-1 text-sm text-gray-600">
                                    После создания пользователя автоматически будет отправлено приглашение в систему на
                                    указанный адрес электронной почты.
                                </p>
                            </header>
                            <UserForm
                                class="max-w-xl"
                                :form="form"
                                :roles="roles"
                            />
                        </section>

                        <PrimaryButton class="mt-4">Сохранить</PrimaryButton>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>

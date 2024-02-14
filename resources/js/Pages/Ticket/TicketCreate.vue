<script setup>
import {Head, router, useForm} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import Icon from "@/Components/Icon.vue";
import TicketForm from "@/Pages/Ticket/Partials/TicketForm.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const props = defineProps({
    labels: Array
})

const form = useForm({
    tenant: null,
    address: null,
    label: null,
    description: null,
})
</script>

<template>
    <Head title="Заявки"/>

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between content-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight self-center">Заявки</h2>
                <SecondaryButton
                    type="button"
                    @click="router.visit(route('ticket.create'))"
                >
                    <Icon name="plus"/>
                </SecondaryButton>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <form
                        @submit.prevent="form.post(route('ticket.store'))"
                        class="max-w-xl"
                    >
                        <section>

                            <header>
                                <h2 class="text-lg font-medium text-gray-900">Создание новой заявки</h2>

                                <p class="mt-1 text-sm text-gray-600">
                                    Описание
                                </p>
                            </header>
                            <TicketForm
                                :form="form"
                                :labels="labels"
                            />

                            <PrimaryButton class="mt-4">Сохранить</PrimaryButton>
                        </section>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>

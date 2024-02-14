<script setup>
import {Head, router, useForm, usePage} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import Icon from "@/Components/Icon.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {onMounted, ref} from "vue";
import DropdownButton from "@/Components/DropdownButton.vue";
import DangerButton from "@/Components/DangerButton.vue";
import Modal from "@/Components/Modal.vue";


const props = defineProps({
    ticket: [Object, Array],
    state: [Object, Array]
})

const confirmingChangeState = ref(false)
const transition = ref(null)
const openConfirmingChangeStateModal = (nextTransition) => {
    transition.value = nextTransition;
    confirmingChangeState.value = true;
}

const setState = (transition) => {

    let form = useForm({
        id: props.ticket.data.id,
        state: transition.target
    })

    form.patch(route('ticket.state', form.id), {
        preserveScroll: true,
        onSuccess: () => closeConfirmingChangeStateModal()
    })
}

const closeConfirmingChangeStateModal = () => {
    transition.value = null
    confirmingChangeState.value = false
}

onMounted(() => {
    console.log(props.state)
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

        <Modal
            :show="confirmingChangeState"
            @close="closeConfirmingChangeStateModal"
            :closeable="true"
        >
            <div class="p-6">
                <p class="font-bold text-2xl mb-2">
                    Подтвердите смену статуса
                </p>
                <p>
                    Вы собираетесь <span class="font-bold">"{{ transition.name }}"</span>
                </p>
                <div class="flex justify-between mt-4">
                    <PrimaryButton @click="setState(transition)">Подтвердить</PrimaryButton>
                    <SecondaryButton @click="closeConfirmingChangeStateModal">Отмена</SecondaryButton>
                </div>
            </div>
        </Modal>

        <div class="py-12">
            <div class="grid grid-cols-3 gap-4 max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="grid grid-rows-subgrid gap-4 col-span-2">
                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        <div>
                            <p>Статус: {{ ticket.data.state }}</p>
                        </div>
                        <div>
                            <p>Арендатор: {{ ticket.data.tenant }}</p>
                        </div>
                        <div>
                            <p>Адрес: {{ ticket.data.address }}</p>
                        </div>
                        <div>
                            <p>Описание: {{ ticket.data.description }}</p>
                        </div>
                        <div>
                            <p>Состояние: {{ ticket.data.label }}</p>
                        </div>
                        <div>
                            <p>Создатель: {{ ticket.data.initiator_id }}</p>
                        </div>
                        <div>
                            <p>Отвественный: {{ ticket.data.assignee }}</p>
                        </div>
                        <div>
                            <p>фио ответственного: {{ ticket.data.assignee_id }}</p>
                        </div>
                        <div>
                            <p>Кто платит: {{ ticket.data.payer }}</p>
                        </div>
                        <div>
                            <p>бюджет: {{ ticket.data.budget }}</p>
                        </div>
                        <div>
                            <p>Когда оплачено: {{ ticket.data.payed_at }}</p>
                        </div>
                        <div>
                            <p>Когда должно быть сделано: {{ ticket.data.deadline }}</p>
                        </div>
                        <div>
                            <p>когда по факту сделано: {{ ticket.data.end_date }}</p>
                        </div>
                        <div class="flex justify-between">
                            <PrimaryButton @click="router.visit(route('ticket.edit', ticket.data.id))">Edit
                            </PrimaryButton>
                        </div>
                    </div>
                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        laksjkdjasdlkj
                    </div>
                </div>
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <p class="mb-4 font-bold text-xl border-b">Смена статуса</p>
                    <div
                        v-for="nextTransition in state.transitions"
                        class="mb-4"
                    >
                        <SecondaryButton
                            class="w-full"
                            @click="openConfirmingChangeStateModal(nextTransition)"
                            :disabled="typeof nextTransition.issues !== 'undefined'"
                        >
                            {{ nextTransition.name }}
                        </SecondaryButton>

                        <p
                            v-for="issue in nextTransition.issues"
                            class="text-xs text-red-500 px-2 py-1"
                        >
                            {{ issue }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>

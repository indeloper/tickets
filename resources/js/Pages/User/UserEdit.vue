<script setup>
import {router, useForm} from "@inertiajs/vue3";
import UserForm from "@/Pages/User/Partials/UserForm.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import Icon from "@/Components/Icon.vue";
import {Head} from '@inertiajs/vue3';
import {onMounted} from "vue";

const props = defineProps({
    user: {
        type: [Array, Object],
        required: true
    },
    roles: {
        type: [Array, Object],
        required: true
    }
})

const form = useForm(props.user.data)

onMounted(() => {
    console.log(props.user)
})
</script>

<template>
    <Head title="Пользователи"/>

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between content-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight self-center">Редактирование пользователя</h2>
                <SecondaryButton @click="router.visit(route('user.index'))">
                    <Icon name="list"/>
                </SecondaryButton>
            </div>
        </template>
        <ul>
            <li>Отправка письма приглашения</li>
            <li>Блокировка/разблокировка пользователя</li>
        </ul>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div v-if="!form.activated || form.blocked" class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div v-if="!form.activated">
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">Пользователь не активирован</h2>
                            <p class="mt-1 text-sm text-gray-600">
                                После создания пользователя автоматически будет отправлено приглашение в систему на
                                указанный адрес электронной почты.
                            </p>
                        </header>
                        <form @submit.prevent="form.post(route('user.unblock', form.id))">
                            <PrimaryButton>
                                Отправить письмо
                            </PrimaryButton>
                        </form>
                    </div>
                    <div v-if="form.blocked">
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">Пользователь заблокирован</h2>
                        </header>
                        <form @submit="form.post(route('user.unblock', form.id))">
                            <PrimaryButton>
                                Разблокировать
                            </PrimaryButton>
                        </form>
                    </div>
                </div>
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <form
                        @submit.prevent="form.put(route('user.update', form.id))"
                        class="max-w-xl"
                    >
                        <section>

                            <header>
                                <h2 class="text-lg font-medium text-gray-900">Данные пользователя</h2>
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

                <div v-if="!form.blocked" class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <form @submit="form.post(route('user.block', form.id))" class="max-w-xl">
                        <PrimaryButton>
                            Заблокировать
                        </PrimaryButton>
                    </form>
                </div>
            </div>
        </div>

    </AuthenticatedLayout>
</template>

<style scoped>

</style>

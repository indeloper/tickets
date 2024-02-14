<script setup>
import UserList from "@/Pages/User/Partials/UserList.vue";
import {Head, router} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import Icon from "@/Components/Icon.vue";

const props = defineProps({
    users: {
        type: [Array, Object],
        required: true
    }
})
</script>

<template>
    <Head title="Пользователи"/>

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between content-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight self-center">Пользователи</h2>
                <SecondaryButton
                    type="button"
                    @click="router.visit(route('user.create'))"
                >
                    <Icon name="plus"/>
                </SecondaryButton>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <UserList :users="users"/>
                </div>
            </div>
        </div>

    </AuthenticatedLayout>
</template>

<style scoped>

</style>

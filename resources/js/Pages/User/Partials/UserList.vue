<script setup>
import {onMounted} from "vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import {router} from "@inertiajs/vue3";
import Icon from "@/Components/Icon.vue";

const props = defineProps({
    users: {
        type: [Array, Object],
        required: true
    }
})

const goToUserPage = (user) => {
    if (window.innerWidth > 1024) return;
    router.visit(route('user.edit', user.id))
}
</script>

<template>
    <section>

        <header>
            <h2 class="text-lg font-medium text-gray-900">Список пользователей системы</h2>
        </header>

        <div class="mt-4">
            <table class="w-full text-sm text-left rtl:text-right dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th class="px-3 py-3"></th>
                    <th
                        scope="col"
                        class="px-6 py-3 xl:hidden"
                    >
                        ФИО
                    </th>
                    <th
                        scope="col"
                        class="px-6 py-3 xl:inline-block hidden"
                    >
                        Фамилия
                    </th>
                    <th
                        scope="col"
                        class="px-6 py-3 xl:inline-block hidden"
                    >
                        Имя
                    </th>
                    <th
                        scope="col"
                        class="px-6 py-3 xl:inline-block hidden"
                    >
                        Отчество
                    </th>
                    <th
                        scope="col"
                        class="px-6 py-3 md:inline-block hidden"
                    >
                        Email
                    </th>
                    <th
                        scope="col"
                        class="px-6 py-3"
                    >
                        Роль
                    </th>
                    <th
                        scope="col"
                        class="px-6 py-3 md:inline-block hidden"
                    >

                    </th>
                </tr>
                </thead>
                <tbody>
                <tr
                    v-for="user in users.data"
                    class="bg-white border-b last:border-none dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-300 transition-all"
                    @click.prevent="goToUserPage(user)"
                >
                    <td class="px-3 py-3">
                        <Icon
                            v-if="!user.activated && !user.blocked"
                            name="warning"
                            label="Пользователь не активирован"
                        />
                        <Icon
                            v-if="user.blocked"
                            name="block"
                            label="Пользователь заблокирован"
                        />
                    </td>
                    <td class="px-6 py-4 xl:hidden">
                        {{ user.last_name }}<br>
                        {{ user.first_name }}<br>
                        {{ user.second_name }}
                    </td>
                    <td class="px-6 py-4 xl:inline-block hidden">
                        {{ user.last_name }}
                    </td>
                    <td class="px-6 py-4 xl:inline-block hidden">
                        {{ user.first_name }}
                    </td>
                    <td class="px-6 py-4 xl:inline-block hidden">
                        {{ user.second_name }}
                    </td>
                    <td class="px-6 py-4 md:inline-block hidden">
                        {{ user.email }}
                    </td>
                    <td class="px-6 py-4">
                        {{ user.role_name }}
                    </td>
                    <td class="px-6 py-4 md:inline-block hidden">
                        <Icon
                            name="eye"
                            @click="router.visit(route('user.edit', user.id))"
                        />
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

    </section>
</template>

<style scoped>

</style>

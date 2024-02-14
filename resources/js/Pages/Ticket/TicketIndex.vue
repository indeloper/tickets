<script setup>
import {Head, router, useForm, usePage} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import Icon from "@/Components/Icon.vue";
import TicketList from "@/Pages/Ticket/Partials/TicketList.vue";
import {onMounted, ref} from "vue";

const props = defineProps({
    tickets: [Object, Array]
})

const currentTab = ref(
    route().params.state ?? Object.keys(props.tickets)[0]
)
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

                    <div class="flex">
                        <SecondaryButton
                            v-for="key in Object.keys(tickets)"
                            :class="{'bg-gray-900': currentTab === key}"
                            @click="currentTab = key"
                        >{{ key }}
                        </SecondaryButton>
                    </div>

                    <div v-for="(ticket, key) in tickets">
                        <TicketList v-if="key === currentTab" :tickets="ticket"/>
                    </div>


                </div>
            </div>
        </div>

    </AuthenticatedLayout>
</template>

<style scoped>

</style>

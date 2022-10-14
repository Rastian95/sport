<template>
    <app-layout title="Books">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <Calendar @dateClick="dateClick" />
            </div>
        </div>
        <calendar-modal :show="showModal" :form="newEvent" @closeModal="closeModal"  @store="store" />
    </app-layout>
</template>
<script >
import { defineComponent } from 'vue'
import AppLayout from '@/Layouts/AppLayout.vue';
import Calendar from '@/Layouts/Components/Calendar.vue';
import CalendarModal from '@/Layouts/Components/CalendarModal.vue';
import {Inertia} from "@inertiajs/inertia";

export default defineComponent({
    name: 'Books',
    components: {
        AppLayout,
        Calendar,
        CalendarModal,
    },
    data() {
        return {
            showModal: false,
            newEvent: {
                title: null,
                start: null,
                end: null,
            }
        }
    },
    methods: {
        closeModal() {
            this.$data.showModal = false;
        },
        dateClick(arg) {
            this.$data.showModal = true;
            this.setModalOpen(arg);
        },
        setModalOpen(obj) {
            this.newEvent.start = obj.dateStr;
            this.newEvent.end = obj.dateStr;
        },
        store(form) {
            let calendarApi = this.$refs.fullcalendar.getApi()
            Inertia.post(route('events.store'), form, {
                onSuccess: page => {
                    calendarApi.refetchEvents()
                    this.$data.showModal = false;
                }
            });
        }
    }
})
</script>

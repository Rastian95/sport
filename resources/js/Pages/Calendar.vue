<script >
import { defineComponent } from 'vue'
import '@fullcalendar/core/vdom'
import FullCalendar from '@fullcalendar/vue3';
import dayGridPlugin from '@fullcalendar/daygrid'
import interactionPlugin from '@fullcalendar/interaction'
import timeGridPlugin from '@fullcalendar/timegrid'
import DialogModal from '@/Components/DialogModal.vue'
import AppLayout from '@/Layouts/AppLayout.vue';
import Datepicker from '@/Layouts/Components/Datepicker.vue'
import ColorPicker from '@/Layouts/Components/ColorPicker.vue'
import { Inertia } from '@inertiajs/inertia'
import { reactive } from 'vue'

export default defineComponent({
    name: 'Calendar',
    components: {
        AppLayout,
        FullCalendar,
        DialogModal,
        Datepicker,
        ColorPicker,
    },
    setup() {
        const form = reactive({
            title: null,
            color: null,
            start: null,
            hora_inicial: null,
            end: null,
            hora_final: null,
            descripcion: null,
        })


        function submit() {
            let calendarApi = this.$refs.fullcalendar.getApi()
            console.log();
            Inertia.post(route('events.store'), form, {
                onSuccess: page => {
                    calendarApi.refetchEvents()
                }
            })
            this.closeModal();
            this.editMode = false;
        }

        return { form, submit }
    },
    data() {
        return {
            event: null,
            editMode: false,
            modalOpen: false,
            calendarOptions: {
                plugins: [ dayGridPlugin, timeGridPlugin, interactionPlugin ],
                initialView: 'dayGridMonth',
                eventSources: [
                    {
                        events(fetchInfo, successCallback, failureCallback) {
                            axios.get(route('events.data', fetchInfo)).then(response => {
                                successCallback(response.data.events)
                            })
                        },
                    }
                ],
                headerToolbar: { left: 'prev,next today', center: 'title', right: 'dayGridMonth,timeGridWeek,timeGridDay' },
                select: this.handleDateSelect,
                eventClick: this.handleEventClick,
                editable: true,
            },
        }
    },
    methods: {
        closeModal: function () {
            this.modalOpen = false;
            this.editMode = false;
        },
        handleDateSelect(arg) {
            this.modalOpen = true;
        },
        handleEventClick(arg) {
            this.modalOpen = true;

        },
    }
})
</script>

<template>
    <app-layout title="Calendar">
        <template #title>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Calendar
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <FullCalendar ref="fullcalendar" :options="calendarOptions" />
                    </div>
                </div>
            </div>
        </div>

        <dialog-modal :show="modalOpen">
            <template #title>
                <h2 class="text-2xl text-slate-800 font-bold mb-6">
                    Editar Evento
                </h2>
            </template>
            <template v-slot:content>
                <form @submit.prevent="submit">
                    <div class="space-y-8 mt-8">
                        <div>
                            <div class="grid gap-5 grid-cols-2 md:grid-cols-3">
                                <div class="col-span-2">
                                    <div>
                                        <label class="block text-sm font-medium mb-1" for="title">Título:</label>
                                        <input id="title" v-model="form.title" class="form-input w-full" type="text" />
                                    </div>
                                </div>
                                <div class="col-span-1">
                                    <div>
                                        <label class="block text-sm font-medium mb-1" for="color">Color:</label>
                                        <ColorPicker v-model="form.color" class="fast-color-picker" color="#7460ee" />
                                    </div>
                                </div>

                                <div class="col-span-2">
                                    <div>
                                        <label class="block text-sm font-medium mb-1" for="start">Fecha Inicial:</label>
                                        <Datepicker id="start" align="left" v-model="form.start" />
                                    </div>
                                </div>
                                <div class="col-span-1">
                                    <div>
                                        <label class="block text-sm font-medium mb-1" for="default">Hora Inicial:</label>
                                        <Datepicker align="left" time="true" />
                                    </div>
                                </div>
                                <div class="col-span-2">
                                    <div>
                                        <label class="block text-sm font-medium mb-1" for="end">Fecha Final:</label>
                                        <Datepicker id="end" v-model="form.end" align="left" />
                                    </div>
                                </div>
                                <div class="col-span-1">
                                    <div>
                                        <label class="block text-sm font-medium mb-1" for="default">Hora Final:</label>
                                        <Datepicker align="left" time="true" />
                                    </div>
                                </div>
                                <div class="col-span-2">
                                    <div>
                                        <label class="block text-sm font-medium mb-1" for="default">Descripción</label>
                                        <textarea class="form-textarea w-full"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </template>
            <template v-slot:footer>
                <button @click="submit" class="btn bg-green-600 hover:bg-green-700 text-gray-100 mr-2" type="submit">Guardar</button>
                <button @click="modalOpen=false" class="btn bg-white hover:bg-gray-100 text-gray-900">Cerrar</button>
            </template>
        </dialog-modal>
    </app-layout>
</template>

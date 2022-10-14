<template>
    <dialog-modal>
        <template #title>
            <h2 class="text-2xl text-slate-800 font-bold mb-6">
                Editar Evento
            </h2>
        </template>
        <template v-slot:content>
            <form>
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
                                    <ColorPicker class="fast-color-picker" color="#7460ee" />
                                </div>
                            </div>

                            <div class="col-span-2">
                                <div>
                                    <label class="block text-sm font-medium mb-1" for="start">Fecha Inicial:</label>
                                    <input id="start" v-model="form.start" class="form-input w-full" type="date" />
                                </div>
                            </div>
                            <div class="col-span-1">
                                <div>
                                    <label class="block text-sm font-medium mb-1" for="hora_inicial">Hora Inicial:</label>
                                    <input id="hora_inicial" class="form-input w-full" type="time" />
                                </div>
                            </div>
                            <div class="col-span-2">
                                <div>
                                    <label class="block text-sm font-medium mb-1" for="end">Fecha Final:</label>
                                    <input id="end" v-model="form.end" class="form-input w-full" type="date" />
                                </div>
                            </div>
                            <div class="col-span-1">
                                <div>
                                    <label class="block text-sm font-medium mb-1" for="default">Hora Final:</label>
                                    <input id="hora_final" class="form-input w-full" type="time" />
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
            <button @click.prevent="store(form)" class="btn bg-green-600 hover:bg-green-700 text-gray-100 mr-2">Guardar</button>
            <button @click.prevent="closeModal" class="btn bg-white hover:bg-gray-100 text-gray-900">Cerrar</button>
        </template>
    </dialog-modal>
</template>
<script>

import '@fullcalendar/core/vdom'
import DialogModal from '@/Components/DialogModal.vue'
import Datepicker from '@/Layouts/Components/Datepicker.vue'
import ColorPicker from '@/Layouts/Components/ColorPicker.vue'

export default {
    name: 'CalendarModal',
    components: {
        DialogModal,
        Datepicker,
        ColorPicker,
    },
    emits: ["closeModal"],
    props: {
        form: {
            type: Object,
            default: () => {}
        }
    },
    methods: {
        closeModal() {
            this.$emit('closeModal');
        },
        store(info) {
            this.$emit('store', info);
        },

    }
}
</script>

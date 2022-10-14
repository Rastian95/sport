<template>
    <div>
        <FullCalendar :options="calendarOptions" />
    </div>
</template>
<script>

import '@fullcalendar/core/vdom'
import FullCalendar from '@fullcalendar/vue3';
import dayGridPlugin from '@fullcalendar/daygrid'
import interactionPlugin from '@fullcalendar/interaction'
import timeGridPlugin from '@fullcalendar/timegrid'

export default {
    name: 'Calendar',
    components: {
        FullCalendar
    },
    data() {
        return {
            calendarOptions: {
                plugins: [
                    dayGridPlugin,
                    timeGridPlugin,
                    interactionPlugin
                ],
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                dateClick: this.handleDateClick,
            }
        }
    },
    methods: {
        handleDateClick(clickInfo) {
            this.$emit('dateClick', clickInfo);
        }
    }
}
</script>

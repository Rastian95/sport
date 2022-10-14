<template>
    <div>
        <Head :title="title" />
        <!-- Page wrapper -->
        <div class="flex h-screen overflow-hidden">
            <!-- Sidebar -->
            <Sidebar :sidebarOpen="sidebarOpen" @close-sidebar="sidebarOpen = false" />
            <!-- Content area -->
            <div class="relative flex flex-col flex-1 overflow-y-auto overflow-x-hidden">
                <!-- Site header -->
                <Header :sidebarOpen="sidebarOpen" @toggle-sidebar="sidebarOpen = !sidebarOpen" />
                <main>
                    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
<!--                        <div class="bg-green-600 px-6 py-4 shadow rounded" v-if="$page.props.flash.message">-->
<!--                            <p class="text-white">{{ $page.props.flash.message }}</p>-->
<!--                        </div>-->
<!--                        <flash v-if="alert !== ''" :message="alert"></flash>-->
                        <slot></slot>
                    </div>
                </main>
            </div>
        </div>
    </div>
</template>

<script>
import { defineComponent } from 'vue';
import { ref } from 'vue'
import { Head, Link } from '@inertiajs/inertia-vue3';
import Flash from "@/Components/Flash.vue";
import Sidebar from '@/Layouts/Partials/Sidebar.vue';
import Header from '@/Layouts/Partials/Header.vue';

export default defineComponent({
    name: "AppLayout",
    props: {
        title: String,
        alert: String,
    },
    setup() {
        const sidebarOpen = ref(false)
        return {
            sidebarOpen,
        }
    },
    components: {
        Head,
        Link,
        Sidebar,
        Header,
        Flash,
    },

    data() {
        return {
            showingNavigationDropdown: false,
        }
    },

    methods: {
        switchToTeam(team) {
            this.$inertia.put(route('current-team.update'), {
                'team_id': team.id
            }, {
                preserveState: false
            })
        },

        logout() {
            this.$inertia.post(route('admin::logout'));
        },

        dropdownHandler(event) {
            let single = event.currentTarget.getElementsByTagName("ul")[0];
            single.classList.toggle("hidden");
        },
        sidebarHandler() {
            var sideBar = document.getElementById("mobile-nav");
            sideBar.classList.toggle("hidden");
        },

        updateparent(variable) {
            console.log(variable);
            this.alert = variable
        }
    }
})
</script>

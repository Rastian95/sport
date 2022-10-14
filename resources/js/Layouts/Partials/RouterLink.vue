<template>

    <li class="px-3 py-2 rounded-sm mb-0.5 last:mb-0" :class="activeCondition && 'bg-slate-900'">
        <Link :href="href" class="block text-slate-200 hover:text-white truncate transition duration-150" :class="activeCondition && 'hover:text-slate-200'">
            <div class="flex items-center">
                <slot name="svg" :active="activeCondition"></slot>
                <span class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                    <slot></slot>
                </span>
            </div>
        </Link>
    </li>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';

export default {
    name: 'RouterLink',
    props: ['activeCondition', 'href'],
    components: {
        Link,
    },

}
</script>

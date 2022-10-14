<template>
    <li class="mb-1 last:mb-0">
        <Link class="block text-slate-400 hover:text-slate-200 transition duration-150 truncate" :class="activeCondition && '!text-indigo-500'" :href="href">
            <span class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                <slot></slot>
            </span>
        </Link>
    </li>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';

export default {
    name: 'RouterLinkSub',
    props: ['activeCondition', 'href'],
    components: {
        Link,
    },

}
</script>

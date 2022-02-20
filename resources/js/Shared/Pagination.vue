<template>
    <div v-if="links.length > 3">
        <ul class="pagination m-0 ms-auto">
            <template v-for="(link, key) in links">
                <li v-if="link.url === null" :key="key" class="page-item btn btn-sm disabled" v-html="link.label" />
                <Link v-else :key="`link-${key}`" class="-my-1 mx-1 page-item btn btn-sm"
                :class="{ 'btn btn-sm py-2 bg-blue text-white page-item active': link.active }" :href="link.url" v-html="link.label" />
            </template>
        </ul>
    </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3'

export default {
    components: {
        Link,
    },
    props: {
        links: Array,
    },
}
</script>

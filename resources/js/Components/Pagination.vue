<template>
    <div
        class="card-footer px-3 border-0 d-flex flex-column flex-lg-row align-items-center justify-content-between"
    >
        <nav aria-label="Page navigation example">
            <ul
                :class="`pagination pagination-sm justify-content-${align} mb-0 mt-4`"
            >
                <li
                    :class="[
                        'page-item',
                        link.url == null ? 'disabled' : '',
                        link.active ? 'active' : ''
                    ]"
                    v-for="(link, index) in links"
                    :key="index"
                >
                    <Link
                        class="page-link"
                        :href="link.url === null ? '#' : link.url"
                    >
                        <div v-html="link.label"></div>
                    </Link>
                </li>
            </ul>
        </nav>

        <div class="fw-normal small mt-4 mt-lg-0">
            Showing <b>{{ show }} </b> out of <b>{{ total }} </b> entries
        </div>
    </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3'

export default {
    props: {
        links: Array,
        align: String,
        show: Number,
        total: Number
    },

    components: {
        Link
    }
}
</script>

<style></style>

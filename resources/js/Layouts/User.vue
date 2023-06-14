<template>
    <nav class="navbar navbar-light bg-white">
        <div class="container-fluid px-5">
            <a href="/" class="navbar-brand">
                <img
                    class="navbar-brand-light"
                    src="/logo-header.png"
                    height="60"
                />
            </a>
            <div class="d-flex">
                <span class="navbar-text pe-4">
                    Selamat Datang,
                    <a href="" class="text-info fs-7">
                        <strong>
                            {{ $page.props.auth.user.name }}
                        </strong>
                    </a>
                </span>
                <a
                    href="/logout"
                    type="button"
                    class="btn btn-sm btn-danger d-inline-flex align-items-center py-0"
                >
                    <svg
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.5"
                        viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg"
                        aria-hidden="true"
                        class="icon icon-xs me-2 py-0"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M5.636 5.636a9 9 0 1012.728 0M12 3v9"
                        ></path>
                    </svg>
                    Logout
                </a>
            </div>
        </div>
    </nav>

    <div class="px-5 mt-4 p-exam">
        <slot />
    </div>
</template>

<script>
//import Link
import { Link } from '@inertiajs/inertia-vue3'

export default {
    //register components
    components: {
        Link
    }
}
</script>

<style>
@media screen and (max-width: 1024px) {
    .p-exam {
        padding: 5px !important;
    }
}
</style>

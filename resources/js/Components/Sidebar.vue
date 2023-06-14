<template>
    <nav
        id="sidebarMenu"
        class="sidebar d-lg-block bg-gray-800 text-white collapse"
        data-simplebar
    >
        <div class="sidebar-inner px-4 pt-3">
            <div
                class="user-card d-flex d-md-none align-items-center justify-content-between justify-content-md-center pb-4"
            >
                <div class="collapse-close d-md-none">
                    <a
                        href="#sidebarMenu"
                        data-bs-toggle="collapse"
                        data-bs-target="#sidebarMenu"
                        aria-controls="sidebarMenu"
                        aria-expanded="true"
                        aria-label="Toggle navigation"
                    >
                        <svg
                            class="icon icon-xs"
                            fill="currentColor"
                            viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"
                            ></path>
                        </svg>
                    </a>
                </div>
            </div>
            <ul class="nav flex-column pt-3 pt-md-0">
                <li class="nav-item">
                    <span class="mt-2 d-flex justify-content-between">
                        <span>
                            <a href="/">
                                <img
                                    src="/logo-header.png"
                                    alt="logo-pei"
                                    height="60"
                                    class="bg-white px-2"
                                />
                            </a>
                        </span>
                    </span>
                </li>

                <li
                    role="separator"
                    class="dropdown-divider mt-2 mb-2 border-gray-700"
                ></li>

                <li
                    class="nav-item"
                    :class="{ active: $page.url.startsWith('/admin/exams') }"
                >
                    <Link
                        href="/admin/exams"
                        class="nav-link d-flex justify-content-between"
                    >
                        <span>
                            <span class="sidebar-icon">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="18"
                                    height="18"
                                    fill="currentColor"
                                    class="bi bi-pencil-square icon icon-xs me-2"
                                    viewBox="0 0 16 16"
                                >
                                    <path
                                        d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"
                                    />
                                    <path
                                        fill-rule="evenodd"
                                        d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"
                                    />
                                </svg>
                            </span>
                            <span class="sidebar-text">Ujian</span>
                        </span>
                    </Link>
                </li>

                <li
                    class="nav-item"
                    :class="{
                        active: $page.url.startsWith('/admin/exam_sessions')
                    }"
                >
                    <Link
                        href="/admin/exam_sessions"
                        class="nav-link d-flex justify-content-between"
                    >
                        <span>
                            <span class="sidebar-icon">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="18"
                                    height="18"
                                    fill="currentColor"
                                    class="bi bi-stopwatch icon icon-xs me-2"
                                    viewBox="0 0 16 16"
                                >
                                    <path
                                        d="M8.5 5.6a.5.5 0 1 0-1 0v2.9h-3a.5.5 0 0 0 0 1H8a.5.5 0 0 0 .5-.5V5.6z"
                                    />
                                    <path
                                        d="M6.5 1A.5.5 0 0 1 7 .5h2a.5.5 0 0 1 0 1v.57c1.36.196 2.594.78 3.584 1.64a.715.715 0 0 1 .012-.013l.354-.354-.354-.353a.5.5 0 0 1 .707-.708l1.414 1.415a.5.5 0 1 1-.707.707l-.353-.354-.354.354a.512.512 0 0 1-.013.012A7 7 0 1 1 7 2.071V1.5a.5.5 0 0 1-.5-.5zM8 3a6 6 0 1 0 .001 12A6 6 0 0 0 8 3z"
                                    />
                                </svg>
                            </span>
                            <span class="sidebar-text">Sesi Ujian</span>
                        </span>
                    </Link>
                </li>
            </ul>
        </div>
    </nav>
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

<style></style>

.
<template>
    <Head>
        <title>Dashboard Siswa - Aplikasi Ujian Online</title>
    </Head>

    <!-- breadcrumb -->
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4"
    >
        <div class="d-block mb-4 mb-md-0">
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
                <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                    <li class="breadcrumb-item">
                        <a href="/">
                            <svg
                                class="icon icon-xxs"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
                                ></path>
                            </svg>
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="/">Beranda</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        List Ujian
                    </li>
                </ol>
            </nav>
            <h2 class="h4">List Ujian</h2>
        </div>
        <div class="btn-toolbar mb-2 mb-md-0"></div>
    </div>
    <!-- /breadcrumb -->

    <!-- table -->
    <div class="row mb-3" v-if="exam_groups?.data?.length > 0">
        <div class="col-md-12">
            <div class="card border-0 shadow">
                <div class="card-body">
                    <div class="table-responsive">
                        <table
                            class="table table-bordered table-centered table-nowrap mb-0 rounded"
                        >
                            <thead class="thead-light">
                                <tr class="border-0">
                                    <th class="border-0">Ujian</th>
                                    <th class="border-0">Function</th>
                                    <th class="border-0">Level</th>
                                    <th class="border-0">Mulai</th>
                                    <th class="border-0">Selesai</th>
                                    <th
                                        class="border-0 rounded-end"
                                        style="width: 15%"
                                    >
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <div class="mt-2"></div>
                            <tbody>
                                <tr
                                    v-for="(data, index) in exam_groups.data"
                                    :key="index"
                                >
                                    <td class="white-space">
                                        {{ data?.exam_group?.exam?.title }} -
                                        {{
                                            data?.exam_group?.exam_session
                                                ?.title
                                        }}
                                    </td>
                                    <td class="white-space">
                                        {{
                                            data?.exam_group?.exam?.peran
                                                ?.nm_peran
                                        }}
                                    </td>
                                    <td class="white-space">
                                        {{
                                            data?.exam_group?.exam?.level?.level
                                        }}
                                    </td>
                                    <td class="white-space">
                                        {{
                                            data?.exam_group?.exam_session
                                                ?.start_time
                                        }}
                                    </td>
                                    <td class="white-space">
                                        {{
                                            data?.exam_group?.exam_session
                                                ?.end_time
                                        }}
                                    </td>
                                    <td class="text-center">
                                        <!-- cek waktu selesai -->
                                        <div
                                            v-if="data?.grade?.end_time == null"
                                        >
                                            <!-- cek apakah ujian sudah dimulai, tapi waktu masih ada -->
                                            <div
                                                v-if="
                                                    examTimeRangeChecker(
                                                        data?.exam_group
                                                            ?.exam_session
                                                            ?.start_time,
                                                        data?.exam_group
                                                            ?.exam_session
                                                            ?.end_time
                                                    )
                                                "
                                            >
                                                <!-- belum mengerjakan -->
                                                <div
                                                    v-if="
                                                        data?.grade
                                                            ?.start_time == null
                                                    "
                                                >
                                                    <Link
                                                        :href="`/exam-confirmation/${data?.exam_group?.id}`"
                                                        class="btn btn-sm btn-success border-0 shadow w-100 text-white"
                                                        >Kerjakan</Link
                                                    >
                                                </div>

                                                <!-- melanjutkan  -->
                                                <div v-else>
                                                    <Link
                                                        :href="`/exam/${data?.exam_group?.id}/1`"
                                                        class="btn btn-sm btn-info border-0 shadow w-100"
                                                        >Lanjut Kerjakan</Link
                                                    >
                                                </div>
                                            </div>

                                            <div v-else>
                                                <!-- ujian belum mulai-->
                                                <div
                                                    v-if="
                                                        examTimeStartChecker(
                                                            data?.exam_group
                                                                ?.exam_session
                                                                ?.start_time
                                                        )
                                                    "
                                                >
                                                    <button
                                                        class="btn btn-sm btn-gray-700 border-0 shadow w-100"
                                                        disabled
                                                    >
                                                        Belum Mulai
                                                    </button>
                                                </div>

                                                <!-- ujian terlewat -->
                                                <div
                                                    v-if="
                                                        examTimeEndChecker(
                                                            data?.exam_group
                                                                ?.exam_session
                                                                ?.end_time
                                                        )
                                                    "
                                                >
                                                    <button
                                                        class="btn btn-sm btn-warning text-white border-0 shadow w-100"
                                                        disabled
                                                    >
                                                        Waktu Terlewat
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- ujian sudah dikerjakan -->
                                        <div v-else>
                                            <button
                                                class="btn btn-sm btn-danger border-0 shadow me-2"
                                                disabled
                                            >
                                                Sudah Dikerjakan
                                            </button>

                                            <Link
                                                :href="`/exam-result/${data?.exam_group?.id}`"
                                                type="button"
                                                class="btn btn-sm btn-success me-2 text-white"
                                            >
                                                Lihat Hasil
                                            </Link>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <Pagination
                        :links="exam_groups?.links"
                        :show="exam_groups?.per_page"
                        :total="exam_groups?.total"
                        align="end"
                    />
                </div>
            </div>
        </div>
    </div>
    <!-- /table -->
    <!-- tidak ada ujian -->
    <div class="row" v-else>
        <div class="col-md-12">
            <div class="alert alert-danger border-0 shadow">
                <i class="fa fa-info-circle"></i> Tidak ada ujian yang tersedia
            </div>
        </div>
    </div>
</template>

<script>
//import layout student
import LayoutStudent from '../../../Layouts/User.vue'

import Pagination from '../../../Components/Pagination.vue'

//import Link from Inertia
import { Link } from '@inertiajs/inertia-vue3'

export default {
    //layout
    layout: LayoutStudent,

    //register components
    components: {
        Link,
        Pagination
    },

    //register props
    props: {
        exam_groups: Object,
        auth: Object
    }
}
</script>

<style></style>

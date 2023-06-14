<template>
    <Head>
        <title>Ujian </title>
    </Head>
    <div class="container-fluid mb-5 mt-5">
        <!-- breadcrumb -->
        <div
            class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4"
        >
            <div class="d-block mb-4 mb-md-0">
                <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
                    <ol
                        class="breadcrumb breadcrumb-dark breadcrumb-transparent"
                    >
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
                            <a href="/">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Data Ujian
                        </li>
                    </ol>
                </nav>
                <h2 class="h4">Data Ujian</h2>
            </div>
            <div class="btn-toolbar mb-2 mb-md-0">
                <Link
                    href="/admin/exams/create"
                    class="btn btn-sm btn-primary d-inline-flex align-items-center"
                >
                    <svg
                        class="icon icon-xs me-2"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"
                        ></path>
                    </svg>
                    Tambah
                </Link>
            </div>
        </div>
        <!-- /breadcrumb -->

        <div class="row">
            <div class="col-md-6 col-12 mb-2">
                <form @submit.prevent="handleSearch">
                    <div class="input-group">
                        <span class="input-group-text border-0 shadow">
                            <i class="fa fa-search"></i>
                        </span>
                        <input
                            type="text"
                            class="form-control border-0 shadow"
                            v-model="search"
                            placeholder="masukkan kata kunci dan enter..."
                        />
                    </div>
                </form>
            </div>
        </div>

        <div class="row mt-1">
            <div class="col-md-12">
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table
                                class="table table-bordered table-centered table-nowrap mb-0 rounded"
                            >
                                <thead class="thead-dark">
                                    <tr class="border-0">
                                        <th
                                            class="border-0 rounded-start"
                                            style="width: 5%"
                                        >
                                            No.
                                        </th>
                                        <th class="border-0">Ujian</th>
                                        <th class="border-0">Function</th>
                                        <th class="border-0">Level</th>
                                        <th class="border-0">Jumlah Soal</th>
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
                                        v-for="(exam, index) in exams.data"
                                        :key="index"
                                    >
                                        <td class="fw-bold text-center">
                                            {{
                                                ++index +
                                                (exams?.current_page - 1) *
                                                    exams?.per_page
                                            }}
                                        </td>
                                        <td>{{ exam?.title }}</td>
                                        <td>
                                            {{ exam?.peran?.nm_peran }}
                                        </td>
                                        <td>{{ exam?.level?.level }}</td>
                                        <td class="text-center">
                                            {{ exam?.questions?.length }}
                                        </td>
                                        <td class="text-center">
                                            <Link
                                                :href="`/admin/exams/${exam?.id}`"
                                                class="btn btn-sm btn-primary border-0 shadow me-2"
                                                type="button"
                                            >
                                                <i class="fa fa-plus-circle">
                                                </i>
                                            </Link>
                                            <Link
                                                :href="`/admin/exams/${exam?.id}/edit`"
                                                class="btn btn-sm btn-info border-0 shadow me-2"
                                                type="button"
                                                ><i class="fa fa-pencil-alt"></i
                                            ></Link>
                                            <button
                                                @click.prevent="
                                                    destroy(exam?.id)
                                                "
                                                class="btn btn-sm btn-danger border-0"
                                            >
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <Pagination
                            :links="exams?.links"
                            :show="exams?.per_page"
                            :total="exams?.total"
                            align="end"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
//import layout
import LayoutAdmin from '../../../Layouts/Admin.vue'

//import component pagination
import Pagination from '../../../Components/Pagination.vue'

//import Heade and Link from Inertia
import { Head, Link } from '@inertiajs/inertia-vue3'

//import ref from vue
import { ref } from 'vue'

//import inertia adapter
import { Inertia } from '@inertiajs/inertia'

//import sweet alert2
import Swal from 'sweetalert2'

export default {
    //layout
    layout: LayoutAdmin,

    //register component
    components: {
        Head,
        Link,
        Pagination
    },

    //props
    props: {
        exams: Object
    },

    //inisialisasi composition API
    setup () {
        //define state search
        const search = ref(
            '' || new URL(document.location).searchParams.get('q')
        )

        //define method search
        const handleSearch = () => {
            Inertia.get('/admin/exams', {
                //send params "q" with value from state "search"
                q: search.value
            })
        }

        //define method destroy
        const destroy = id => {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: 'Anda tidak akan dapat mengembalikan ini!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then(result => {
                if (result.isConfirmed) {
                    Inertia.delete(`/admin/exams/${id}`, {
                        onSuccess: () => {
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: toast => {
                                    toast.addEventListener(
                                        'mouseenter',
                                        Swal.stopTimer
                                    )
                                    toast.addEventListener(
                                        'mouseleave',
                                        Swal.resumeTimer
                                    )
                                }
                            })
                            Toast.fire({
                                icon: 'success',
                                title: 'Data berhasil dihapus.'
                            })
                        },
                        onError: err => {
                            if (err.message) {
                                const Toast = Swal.mixin({
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000,
                                    timerProgressBar: true,
                                    didOpen: toast => {
                                        toast.addEventListener(
                                            'mouseenter',
                                            Swal.stopTimer
                                        )
                                        toast.addEventListener(
                                            'mouseleave',
                                            Swal.resumeTimer
                                        )
                                    }
                                })
                                Toast.fire({
                                    icon: 'error',
                                    title: err.message || 'Data gagal dihapus.'
                                })
                            }
                        }
                    })
                }
            })
        }

        //return
        return {
            search,
            handleSearch,
            destroy
        }
    }
}
</script>

<style></style>

<template>
    <Head>
        <title>Nilai Ujian</title>
    </Head>
    <div class="container-fluid mb-5 mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow mb-4">
                    <div class="card-body">
                        <h5><i class="fa fa-filter"></i> Filter Data</h5>
                        <hr />
                        <form @submit.prevent="filter">
                            <div class="row">
                                <div class="col-md-9">
                                    <label class="control-label" for="name"
                                        >Ujian</label
                                    >
                                    <select
                                        class="form-select"
                                        v-model="form.exam_id"
                                    >
                                        <option
                                            v-for="(exam, index) in exams"
                                            :key="index"
                                            :value="exam.id"
                                            :class="
                                                errors.exam_id
                                                    ? 'is-invalid'
                                                    : ''
                                            "
                                        >
                                            {{ exam?.title }} — Peran :
                                            {{ exam?.peran?.nm_peran }}
                                            -
                                            {{ exam?.level?.level }}
                                        </option>
                                    </select>
                                    <div
                                        v-if="errors.exam_id"
                                        class="invalid-feedback mt-2"
                                    >
                                        {{ errors.exam_id }}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label fw-bold text-white"
                                        >*</label
                                    >
                                    <button
                                        type="submit"
                                        class="btn btn-md btn-primary border-0 shadow w-100"
                                    >
                                        <i class="fa fa-filter"></i> Filter
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div
                    v-if="grades?.data?.length > 0"
                    class="card border-0 shadow"
                >
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-9 col-12">
                                <h5 class="mt-2">
                                    <i class="fa fa-chart-line"></i>
                                    Nilai Ujian
                                </h5>
                            </div>
                            <div class="col-md-3 col-12">
                                <a
                                    :href="`/admin/grade/export?exam_id=${form.exam_id}`"
                                    target="_blank"
                                    class="btn btn-success btn-md border-0 shadow w-100 text-white"
                                    ><i class="fa fa-file-excel"></i> DOWNLOAD
                                    EXCEL</a
                                >
                            </div>
                        </div>
                        <hr />

                        <div class="row mb-2">
                            <div class="col-md-6 col-12 mb-2">
                                <form @submit.prevent="handleSearch">
                                    <div class="input-group">
                                        <input
                                            type="text"
                                            class="form-control"
                                            v-model="search"
                                            placeholder="masukkan kata kunci dan enter..."
                                        />
                                        <span class="input-group-text">
                                            <i class="fa fa-search"></i>
                                        </span>
                                    </div>
                                </form>
                            </div>
                        </div>

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
                                        <th class="border-0">ID User</th>
                                        <th class="border-0">Nama</th>
                                        <th class="border-0">Jumlah Benar</th>
                                        <th class="border-0">Jumlah Salah</th>
                                        <th class="border-0">Nilai</th>
                                    </tr>
                                </thead>
                                <div class="mt-2"></div>
                                <tbody>
                                    <tr
                                        v-for="(grade, index) in grades.data"
                                        :key="grade.id"
                                    >
                                        <td
                                            class="fw-bold text-center white-space"
                                        >
                                            {{ index + 1 }}
                                        </td>
                                        <td class="white-space">
                                            {{ grade?.exam?.title }} -
                                            {{ grade?.exam_session?.title }}
                                        </td>
                                        <td>
                                            {{ grade?.user?.id_user }}
                                        </td>
                                        <td>
                                            {{ grade?.user?.name }}
                                        </td>
                                        <td>
                                            {{ grade?.total_correct }}
                                        </td>
                                        <td>
                                            {{ grade?.total_incorrect }}
                                        </td>
                                        <td class="fw-bold text-center">
                                            {{ grade?.grade }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <Pagination
                            :links="grades?.links"
                            :show="grades?.per_page"
                            :total="grades?.total"
                            align="end"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
//import layout Admin
import LayoutAdmin from '../../../Layouts/Admin.vue'

//import Head from Inertia
import { Head } from '@inertiajs/inertia-vue3'

//import component pagination
import Pagination from '../../../Components/Pagination.vue'

//import reactive from vue
import { reactive, ref } from 'vue'

//import inerita adapter
import { Inertia } from '@inertiajs/inertia'

//import sweet alert2
import Swal from 'sweetalert2'

export default {
    //layout
    layout: LayoutAdmin,

    //register components
    components: {
        Head,
        Pagination
    },

    //props
    props: {
        errors: Object,
        exams: Array,
        grades: Array
    },

    //inisialisasi composition API
    setup () {
        //define state search
        const search = ref(
            '' || new URL(document.location).searchParams.get('q')
        )

        //define state
        const form = reactive({
            exam_id:
                '' || new URL(document.location).searchParams.get('exam_id')
        })

        //define method search
        const handleSearch = () => {
            Inertia.get(`/admin/grade/filter`, {
                //send params "q" with value from state "search"
                q: search.value,
                exam_id: form.exam_id
            })
        }

        //define methods filter
        const filter = () => {
            //HTTP request
            Inertia.get(
                '/admin/grade/filter',
                {
                    //send data to server
                    exam_id: form.exam_id
                },
                {
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
                                title: err.message || 'Data gagal ditampilkan.'
                            })
                        }
                    }
                }
            )
        }

        //return
        return {
            form,
            filter,
            search,
            handleSearch
        }
    }
}
</script>

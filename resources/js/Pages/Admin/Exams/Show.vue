<template>
    <Head>
        <title>Detail Ujian</title>
    </Head>
    <div class="container-fluid mb-5 mt-5">
        <div class="row">
            <div class="col-md-12">
                <Link
                    href="/admin/exams"
                    class="btn btn-md btn-primary border-0 shadow mb-3"
                    type="button"
                    ><i class="fa fa-long-arrow-alt-left me-2"></i>
                    Kembali</Link
                >

                <div class="card border-0 shadow mb-4">
                    <div class="card-body">
                        <h5><i class="fa fa-edit"></i> Detail Ujian</h5>
                        <hr />
                        <div class="table-responsive">
                            <table
                                class="table table-bordered table-centered table-nowrap mb-0 rounded"
                            >
                                <tbody>
                                    <tr>
                                        <td style="width: 30%" class="fw-bold">
                                            Nama Ujian
                                        </td>
                                        <td>{{ exam?.title }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Function</td>
                                        <td>{{ exam?.peran?.nm_peran }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Level</td>
                                        <td>{{ exam?.level?.level }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Acak Soal</td>
                                        <td>{{ exam?.random_question }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Acak Jawaban</td>
                                        <td>{{ exam?.random_answer }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Tampilkan Hasil</td>
                                        <td>{{ exam?.show_answer }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Jumlah Soal</td>
                                        <td>
                                            {{ exam?.questions?.data?.length }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Durasi (Menit)</td>
                                        <td>{{ exam?.duration }} Menit</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">
                                            Status Kelulusan
                                        </td>
                                        <td>{{ exam?.status }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow">
                    <div class="card-body">
                        <h5>
                            <i class="fa fa-question-circle"></i> Soal Ujian
                        </h5>
                        <hr />

                        <Link
                            :href="`/admin/exams/${exam?.id}/questions/create`"
                            class="btn btn-md btn-primary border-0 shadow me-2"
                            type="button"
                            ><i class="fa fa-plus-circle"></i> Tambah</Link
                        >
                        <Link
                            :href="`/admin/exams/${exam?.id}/questions/import`"
                            class="btn btn-md btn-success border-0 shadow text-white"
                            type="button"
                            ><i class="fa fa-file-excel"></i> Import</Link
                        >

                        <div class="row">
                            <div class="col-md-6 col-12 mt-3">
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

                        <div class="table-responsive mt-3">
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
                                        <th class="border-0">Soal</th>
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
                                        v-for="(question, index) in exam
                                            ?.questions?.data"
                                        :key="index"
                                    >
                                        <td class="fw-bold text-center">
                                            {{
                                                ++index +
                                                (exam?.questions?.current_page -
                                                    1) *
                                                    exam?.questions?.per_page
                                            }}
                                        </td>
                                        <td>
                                            <!-- soal text -->
                                            <div
                                                v-if="question?.question"
                                                class="white-space fw-bold"
                                                v-html="question?.question"
                                            ></div>
                                            <!-- soal audio -->
                                            <audio
                                                controls
                                                v-if="question?.question_file"
                                            >
                                                <source
                                                    :src="`/storage/exams/question/${question?.question_file}`"
                                                    type="audio/mpeg"
                                                />
                                            </audio>

                                            <hr />
                                            <ol type="A">
                                                <li
                                                    class="white-space"
                                                    v-html="question?.option_1"
                                                    :class="{
                                                        'text-success fw-bold':
                                                            question?.answer ==
                                                            '1'
                                                    }"
                                                ></li>
                                                <li
                                                    class="white-space"
                                                    v-html="question?.option_2"
                                                    :class="{
                                                        'text-success fw-bold':
                                                            question?.answer ==
                                                            '2'
                                                    }"
                                                ></li>
                                                <li
                                                    class="white-space"
                                                    v-html="question?.option_3"
                                                    :class="{
                                                        'text-success fw-bold':
                                                            question?.answer ==
                                                            '3'
                                                    }"
                                                ></li>
                                                <li
                                                    class="white-space"
                                                    v-html="question?.option_4"
                                                    :class="{
                                                        'text-success fw-bold':
                                                            question?.answer ==
                                                            '4'
                                                    }"
                                                ></li>
                                                <li
                                                    class="white-space"
                                                    v-html="question?.option_5"
                                                    :class="{
                                                        'text-success fw-bold':
                                                            question?.answer ==
                                                            '5'
                                                    }"
                                                ></li>
                                            </ol>
                                        </td>
                                        <td class="text-center">
                                            <Link
                                                :href="`/admin/exams/${exam?.id}/questions/${question?.id}/edit`"
                                                class="btn btn-sm btn-info border-0 shadow me-2"
                                                type="button"
                                                ><i class="fa fa-pencil-alt"></i
                                            ></Link>
                                            <button
                                                @click.prevent="
                                                    destroy(
                                                        exam?.id,
                                                        question?.id
                                                    )
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
                            :links="exam?.questions.links"
                            :show="exam?.questions?.per_page"
                            :total="exam?.questions?.total"
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

//import inertia adapter
import { Inertia } from '@inertiajs/inertia'

//import sweet alert2
import Swal from 'sweetalert2'

//import reactive from vue
import { ref } from 'vue'

export default {
    //layout
    layout: LayoutAdmin,

    //register components
    components: {
        Head,
        Link,
        Pagination
    },

    //props
    props: {
        errors: Object,
        exam: Object
    },

    //inisialisasi composition API
    setup (props) {
        //define state search
        const search = ref(
            '' || new URL(document.location).searchParams.get('q')
        )

        //define method search
        const handleSearch = () => {
            Inertia.get(`/admin/exams/${props.exam.id}`, {
                //send params "q" with value from state "search"
                q: search.value
            })
        }

        //define method destroy
        const destroy = (exam_id, question_id) => {
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
                    Inertia.delete(
                        `/admin/exams/${exam_id}/questions/${question_id}/destroy`,
                        {
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
                                        title:
                                            err.message || 'Data gagal dihapus.'
                                    })
                                }
                            }
                        }
                    )
                }
            })
        }

        //return
        return {
            destroy,
            search,
            handleSearch
        }
    }
}
</script>

<style></style>

<template>
    <Head>
        <title>Ujian Dengan Nomor Soal : {{ page }}</title>
    </Head>
    <div class="row mb-5">
        <!-- deskripsi -->
        <div class="col-md-12 mb-2">
            <div class="card border-0 shadow">
                <div class="card-body">
                    <h5>
                        {{ exam_group?.exam?.title }} -
                        {{ exam_group?.exam_session?.title }}
                    </h5>

                    <div class="table-responsive">
                        <table
                            class="table table-centered table-nowrap mb-0 rounded table-borderless"
                        >
                            <thead>
                                <tr>
                                    <td
                                        class="fw-bold ps-0 py-1"
                                        style="width: 5%"
                                    >
                                        Nama Lengkap
                                    </td>
                                    <td class="py-1">
                                        : {{ $page.props.auth.user.name }}
                                    </td>
                                </tr>
                                <tr>
                                    <td
                                        class="fw-bold ps-0 py-1"
                                        style="width: 5%"
                                    >
                                        Durasi
                                    </td>
                                    <td class="py-1">
                                        : {{ exam_group?.exam?.duration }} Menit
                                    </td>
                                </tr>
                                <tr>
                                    <td
                                        class="fw-bold ps-0 py-1"
                                        style="width: 5%"
                                    >
                                        Total Soal
                                    </td>
                                    <td class="py-1">
                                        :
                                        {{
                                            exam_group?.exam?.questions?.length
                                        }}
                                    </td>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- ujian -->
        <div class="col-md-8 my-2">
            <div
                class="card border-0 shadow mb-3 p-0"
                style="background-color: #fbfafb"
            >
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h5 class="mb-0">
                                Soal No.
                                <span
                                    class="text-white bg-info px-2"
                                    style="border-radius: 3px"
                                >
                                    <strong class="fw-bold">{{ page }}</strong>
                                </span>
                            </h5>
                        </div>
                        <div>
                            <VueCountdown
                                :time="duration"
                                @end="showModalEndTimeExam = true"
                                v-slot="{ hours, minutes, seconds }"
                            >
                                <span
                                    class="badge bg-info p-2"
                                    style="border-radius: 3px"
                                >
                                    <i class="fa fa-clock"> </i> | {{ hours }} :
                                    {{ minutes }} : {{ seconds }}
                                </span>
                            </VueCountdown>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="bg-white p-3 border rounded-1">
                        <div v-if="question_active !== null">
                            <div>
                                <!-- soal audio -->
                                <audio
                                    controls
                                    v-if="
                                        question_active?.question?.question_file
                                    "
                                >
                                    <source
                                        :src="`/storage/exams/question/${question_active?.question?.question_file}`"
                                        type="audio/mpeg"
                                    />
                                </audio>

                                <!-- soal text -->
                                <p
                                    v-if="question_active?.question?.question"
                                    v-html="question_active?.question?.question"
                                ></p>

                                <hr />
                            </div>

                            <table>
                                <tbody>
                                    <tr
                                        v-for="(answer, index) in answer_order"
                                        :key="index"
                                    >
                                        <td width="50" style="padding: 10px">
                                            <!-- active jawaban -->
                                            <button
                                                v-if="
                                                    answer ==
                                                    question_active?.answer
                                                "
                                                class="btn btn-info btn-sm w-100 shdaow"
                                            >
                                                {{ options[index] }}
                                            </button>

                                            <!-- tidak acitve -->
                                            <button
                                                v-else
                                                @click.prevent="
                                                    submitAnswer(
                                                        question_active
                                                            ?.question?.exam
                                                            ?.id,
                                                        question_active
                                                            ?.question?.id,
                                                        answer
                                                    )
                                                "
                                                class="btn btn-outline-primary btn-sm w-100 shdaow"
                                            >
                                                {{ options[index] }}
                                            </button>
                                        </td>
                                        <td style="padding: 10px">
                                            <p
                                                v-html="
                                                    question_active?.question[
                                                        'option_' + answer
                                                    ]
                                                "
                                            ></p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div v-else>
                            <div class="alert alert-danger border-0 shadow">
                                <i class="fa fa-exclamation-triangle"></i> Soal
                                Tidak Ditemukan!.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- button next back -->
            <div class="d-flex justify-content-between">
                <div class="text-start">
                    <button
                        v-if="page > 1"
                        @click.prevent="prevPage"
                        type="button"
                        class="btn btn-info btn-sm btn-block mb-2"
                    >
                        <i
                            class="fa fa-arrow-left"
                            style="font-size: 12px; padding-right: 5px"
                        ></i>

                        Back
                    </button>
                </div>
                <div class="text-end">
                    <button
                        v-if="page < Object.keys(all_questions).length"
                        @click.prevent="nextPage"
                        type="button"
                        class="btn btn-info btn-sm"
                    >
                        Next
                        <i
                            class="fa fa-arrow-right"
                            style="font-size: 12px; padding-left: 5px"
                        ></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="col-md-4 my-2">
            <div class="card border-0 shadow mb-3">
                <div class="card-header text-center">
                    <div class="badge bg-info p-2">
                        <i class="fa fa-check-circle"></i>
                        {{ question_answered }} dikerjakan
                    </div>
                    <div class="badge bg-success p-2 m-2">
                        <i class="fa fa-book"></i>
                        {{ all_questions?.length }} Total Soal
                    </div>
                </div>
                <div class="card-body" style="overflow-y: auto">
                    <div
                        v-for="(question, index) in all_questions"
                        :key="index"
                    >
                        <div width="20%" style="width: 20%; float: left">
                            <div style="padding: 5px">
                                <button
                                    @click.prevent="clickQuestion(index)"
                                    v-if="index + 1 == page"
                                    class="btn btn-gray-400 btn-sm w-100"
                                >
                                    {{ index + 1 }}
                                </button>

                                <button
                                    @click.prevent="clickQuestion(index)"
                                    v-if="
                                        index + 1 != page &&
                                        question.answer == 0
                                    "
                                    class="btn btn-outline-primary btn-sm w-100"
                                >
                                    {{ index + 1 }}
                                </button>

                                <button
                                    @click.prevent="clickQuestion(index)"
                                    v-if="
                                        index + 1 != page &&
                                        question?.answer != 0
                                    "
                                    class="btn btn-info btn-sm w-100"
                                >
                                    {{ index + 1 }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card p-4">
                <button
                    @click="showModalEndExam = true"
                    class="btn btn-info btn-md border-0 shadow w-100"
                >
                    Kirim Jawaban
                </button>
            </div>
        </div>
    </div>

    <!-- modal akhiri ujian -->
    <div
        v-if="showModalEndExam"
        class="modal fade"
        :class="{ show: showModalEndExam }"
        tabindex="-1"
        aria-hidden="true"
        style="display: block"
        role="dialog"
    >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Akhiri Ujian ?</h5>
                </div>
                <div class="modal-body">
                    Setelah mengakhiri ujian, Anda tidak dapat kembali ke ujian
                    ini lagi. Yakin akan mengakhiri ujian?
                </div>
                <div class="modal-footer">
                    <button
                        @click.prevent="endExam"
                        type="button"
                        class="btn btn-primary"
                    >
                        Ya, Akhiri
                    </button>
                    <button
                        @click.prevent="showModalEndExam = false"
                        type="button"
                        class="btn btn-secondary"
                    >
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- modal waktu ujian berakhir -->
    <div
        v-if="showModalEndTimeExam"
        class="modal fade"
        :class="{ show: showModalEndTimeExam }"
        data-bs-backdrop="static"
        data-bs-keyboard="false"
        tabindex="-1"
        aria-hidden="true"
        style="display: block"
        role="dialog"
    >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Waktu Habis !</h5>
                </div>
                <div class="modal-body">
                    Waktu ujian sudah berakhir!. Klik
                    <strong class="fw-bold">Ya</strong> untuk mengakhiri ujian.
                </div>
                <div class="modal-footer">
                    <button
                        @click.prevent="endExam"
                        type="button"
                        class="btn btn-primary"
                    >
                        Ya
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
//import layout student
import LayoutStudent from '../../../Layouts/User.vue'

//import Head and Link from Inertia
import { Head, Link } from '@inertiajs/inertia-vue3'

//import ref
import { ref, onBeforeUnmount } from 'vue'

//import VueCountdown
import VueCountdown from '@chenfengyuan/vue-countdown'

//import axios
import axios from 'axios'

//import inertia adapter
import { Inertia } from '@inertiajs/inertia'

//import sweet alert2
import Swal from 'sweetalert2'

export default {
    //layout
    layout: LayoutStudent,

    //register components
    components: {
        Head,
        Link,
        VueCountdown
    },

    //props
    props: {
        id: Number,
        page: Number,
        exam_group: Object,
        all_questions: Array,
        question_answered: Number,
        question_active: Object,
        answer_order: Array,
        duration: Object
    },

    //composition API
    setup (props) {
        //define options for answer
        let options = ['A', 'B', 'C', 'D', 'E']

        const duration = ref(props.duration.duration)
        let intervalId

        const updateDuration = () => {
            // Mengurangi durasi sebesar 5 detik (5000 milidetik)
            duration.value -= 5000

            // Update durasi ke backend menggunakan Inertia.js atau Axios jika diperlukan
            axios.put(`/exam-duration/update/${props.duration.id}`, {
                duration: duration.value
            })
        }

        // Memanggil updateDuration setiap 5 detik
        intervalId = setInterval(updateDuration, 5000)

        onBeforeUnmount(() => {
            clearInterval(intervalId) // Membersihkan interval saat komponen dihancurkan
        })

        //metohd prevPage
        const prevPage = () => {
            //update duration
            axios.put(`/exam-duration/update/${props.duration.id}`, {
                duration: duration.value
            })

            //redirect to prevPage
            Inertia.get(`/exam/${props.id}/${props.page - 1}`)
        }

        //method nextPage
        const nextPage = () => {
            //update duration
            axios.put(`/exam-duration/update/${props.duration.id}`, {
                duration: duration.value
            })

            //redirect to nextPage
            Inertia.get(`/exam/${props.id}/${props.page + 1}`)
        }

        //method clickQuestion
        const clickQuestion = index => {
            //update duration
            axios.put(`/exam-duration/update/${props.duration.id}`, {
                duration: duration.value
            })

            //redirect to questin
            Inertia.get(`/exam/${props.id}/${index + 1}`)
        }

        //method submit answer
        const submitAnswer = (exam_id, question_id, answer) => {
            Inertia.post('/exam-answer', {
                exam_id: exam_id,
                exam_session_id: props.exam_group.exam_session.id,
                question_id: question_id,
                answer: answer,
                duration: duration.value
            })
        }

        //define state modal
        const showModalEndExam = ref(false)
        const showModalEndTimeExam = ref(false)

        //method endExam
        const endExam = () => {
            Inertia.post('/exam-end', {
                exam_group_id: props.exam_group.id,
                exam_id: props.exam_group.exam.id,
                exam_session_id: props.exam_group.exam_session.id
            })

            //show success alert
            Swal.fire({
                title: 'Success!',
                text: 'Ujian Selesai!.',
                icon: 'success',
                showConfirmButton: false,
                timer: 4000
            })
        }

        //return
        return {
            options,
            duration,
            prevPage,
            nextPage,
            clickQuestion,
            submitAnswer,
            showModalEndExam,
            showModalEndTimeExam,
            endExam
        }
    }
}
</script>

<style></style>

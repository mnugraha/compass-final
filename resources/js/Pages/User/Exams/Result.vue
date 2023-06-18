<template>
    <Head>
        <title>Hasil Ujian</title>
    </Head>

    <!-- Hasil ujian -->
    <div class="row">
        <!-- kembali -->
        <div
            class="col-12 d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center"
        >
            <Link
                href="/exam"
                class="btn btn-md btn-primary border-0 shadow mb-3"
                type="button"
                ><i class="fa fa-long-arrow-alt-left me-2"></i>
                Kembali
            </Link>
        </div>

        <!-- Soal Ujian -->
        <div class="col-lg-7 col-md-4 col-12 mb-3">
            <div class="card border-0 shadow">
                <div class="card-body">
                    <h5><i class="fa fa-question-circle"></i> Soal Ujian</h5>
                    <hr />

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
                                </tr>
                            </thead>
                            <div class="mt-2"></div>
                            <tbody>
                                <tr
                                    v-for="(
                                        question, index
                                    ) in all_questions.data"
                                    :key="index"
                                >
                                    <td class="fw-bold text-center">
                                        {{
                                            ++index +
                                            (all_questions?.current_page - 1) *
                                                all_questions?.per_page
                                        }}
                                    </td>
                                    <td>
                                        <!-- soal text -->
                                        <div
                                            v-if="question?.question?.question"
                                            class="fw-bold"
                                            v-html="
                                                question?.question?.question
                                            "
                                        ></div>
                                        <!-- soal audio -->
                                        <audio
                                            controls
                                            v-if="
                                                question?.question
                                                    ?.question_file
                                            "
                                        >
                                            <source
                                                :src="`/storage/exams/question/${question?.question?.question_file}`"
                                                type="audio/mpeg"
                                            />
                                        </audio>

                                        <hr />
                                        <ol type="A">
                                            <li
                                                v-html="
                                                    question?.question?.option_1
                                                "
                                                :class="{
                                                    'text-info fw-bold':
                                                        question?.answer == '1'
                                                }"
                                            ></li>
                                            <li
                                                v-html="
                                                    question?.question?.option_2
                                                "
                                                :class="{
                                                    'text-info fw-bold':
                                                        question?.answer == '2'
                                                }"
                                            ></li>
                                            <li
                                                v-html="
                                                    question?.question?.option_3
                                                "
                                                :class="{
                                                    'text-info fw-bold':
                                                        question?.answer == '3'
                                                }"
                                            ></li>
                                            <li
                                                v-html="
                                                    question?.question?.option_4
                                                "
                                                :class="{
                                                    'text-info fw-bold':
                                                        question?.answer == '4'
                                                }"
                                            ></li>
                                            <li
                                                v-html="
                                                    question?.question?.option_5
                                                "
                                                :class="{
                                                    'text-info fw-bold':
                                                        question?.answer == '5'
                                                }"
                                            ></li>
                                        </ol>
                                        <!-- alert -->
                                        <div
                                            class="alert alert-gray-800"
                                            role="alert"
                                        >
                                            <p
                                                v-if="
                                                    question?.is_correct === 'Y'
                                                "
                                                class="text-success fw-bold"
                                            >
                                                Benar
                                            </p>
                                            <p
                                                v-else
                                                class="text-danger fw-bold"
                                            >
                                                Salah
                                            </p>
                                        </div>
                                        <!-- /alert -->
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <Pagination
                        :links="all_questions.links"
                        :show="all_questions?.per_page"
                        :total="all_questions?.total"
                        align="end"
                    />
                </div>
            </div>
        </div>

        <!-- Hasil ujian -->
        <div class="col-lg-5 col-md-8 col-12">
            <div class="card border-0 shadow mb-4">
                <div class="card-body">
                    <h5><i class="fa fa-check-circle"></i> Hasil Ujian</h5>

                    <hr />
                    <div class="table-responsive">
                        <table
                            class="table table-bordered table-centered table-nowrap mb-0 rounded"
                        >
                            <tbody>
                                <tr>
                                    <td style="width: 25%" class="fw-bold">
                                        Nama Lengkap
                                    </td>
                                    <td class="white-space">
                                        {{ exam_group?.user?.name }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 25%" class="fw-bold">
                                        Ujian
                                    </td>
                                    <td class="white-space">
                                        {{ exam_group?.exam?.title }} -
                                        {{ exam_group?.exam_session?.title }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 25%" class="fw-bold">
                                        Mulai Mengerjakan
                                    </td>
                                    <td>{{ grade?.start_time }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 25%" class="fw-bold">
                                        Selesai Mengerjakan
                                    </td>
                                    <td>{{ grade?.end_time }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 25%" class="fw-bold">
                                        Jumlah Soal
                                    </td>
                                    <td>
                                        {{
                                            exam_group?.exam?.questions?.length
                                        }}
                                    </td>
                                </tr>

                                <tr v-if="exam_group?.exam?.show_answer == 'Y'">
                                    <td style="width: 25%" class="fw-bold">
                                        Jumlah Benar
                                    </td>
                                    <td>{{ grade?.total_correct }}</td>
                                </tr>
                                <tr v-if="exam_group?.exam?.show_answer == 'Y'">
                                    <td style="width: 25%" class="fw-bold">
                                        Jumlah Salah
                                    </td>
                                    <td>{{ grade?.total_incorrect }}</td>
                                </tr>
                                <tr v-if="exam_group?.exam?.show_answer == 'Y'">
                                    <td style="width: 25%" class="fw-bold">
                                        Nilai
                                    </td>
                                    <td>{{ grade?.grade }}</td>
                                </tr>
                                <tr>
                                    <td>Download</td>
                                    <td>
                                        <!-- Download button -->
                                        <a
                                            @click="generatePDF(grade?.id)"
                                            class="btn btn-info mb-0"
                                        >
                                            <i class="fa fa-file-pdf me-2"></i>
                                            Download PDF
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
//import layout student
import LayoutStudent from '../../../Layouts/User.vue'

// import pagination
import Pagination from '../../../Components/Pagination.vue'

//import Head and Link from Inertia
import { Head, Link } from '@inertiajs/inertia-vue3'

export default {
    //layout
    layout: LayoutStudent,

    //register components
    components: {
        Head,
        Link,
        Pagination
    },

    //props
    props: {
        exam_group: Object,
        grade: Object,
        all_questions: Object
    },

    methods: {
        // ubah status
        generatePDF (id) {
            window.open(`/grade/print-pdf/${id}`, '_blank')
        }
    }
}
</script>

<style></style>

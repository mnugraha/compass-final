<template>
    <Head>
        <title>Tambah Soal Ujian</title>
    </Head>
    <div class="container-fluid mb-5 mt-5">
        <div class="row">
            <div class="col-md-12">
                <Link
                    :href="`/admin/exams/${exam.id}`"
                    class="btn btn-md btn-primary border-0 shadow mb-3"
                    type="button"
                    ><i class="fa fa-long-arrow-alt-left me-2"></i>
                    Kembali</Link
                >
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <h5>
                            <i class="fa fa-question-circle"></i> Tambah Soal
                            Ujian
                        </h5>
                        <hr />
                        <form @submit.prevent="submit">
                            <div class="table-responsive mb-4">
                                <table
                                    class="table table-bordered table-centered table-nowrap mb-0 rounded"
                                >
                                    <tbody>
                                        <tr>
                                            <td
                                                rowspan="2"
                                                style="width: 20%"
                                                class="fw-bold"
                                            >
                                                Soal
                                            </td>
                                            <td>
                                                <div
                                                    class="form-check form-check-inline"
                                                >
                                                    <input
                                                        class="form-check-input"
                                                        type="radio"
                                                        name="question_type"
                                                        id="question_type1"
                                                        value="text"
                                                        v-model="
                                                            form.question_type
                                                        "
                                                    />
                                                    <label
                                                        class="form-check-label"
                                                        for="question_type1"
                                                    >
                                                        TEXT
                                                    </label>
                                                </div>
                                                <div
                                                    class="form-check form-check-inline"
                                                >
                                                    <input
                                                        class="form-check-input"
                                                        type="radio"
                                                        name="question_type"
                                                        id="question_type2"
                                                        value="audio"
                                                        v-model="
                                                            form.question_type
                                                        "
                                                    />
                                                    <label
                                                        class="form-check-label"
                                                        for="question_type2"
                                                    >
                                                        AUDIO
                                                    </label>
                                                </div>
                                                <div
                                                    v-if="errors.question_type"
                                                    class="text-danger small mt-2"
                                                >
                                                    {{ errors.question_type }}
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div
                                                    v-if="
                                                        form.question_type ===
                                                        'text'
                                                    "
                                                >
                                                    <Editor
                                                        api-key="no-api-key"
                                                        v-model="form.question"
                                                        :init="editorConfig"
                                                        :class="
                                                            errors.question
                                                                ? 'is-invalid'
                                                                : ''
                                                        "
                                                    />
                                                    <div
                                                        v-if="errors.question"
                                                        class="invalid-feedback mt-2"
                                                    >
                                                        {{ errors.question }}
                                                    </div>
                                                </div>

                                                <div
                                                    v-if="
                                                        form.question_type ===
                                                        'audio'
                                                    "
                                                >
                                                    <input
                                                        type="file"
                                                        class="form-control"
                                                        @input="
                                                            form.question_file =
                                                                $event.target.files[0]
                                                        "
                                                        :class="
                                                            errors.question_file
                                                                ? 'is-invalid'
                                                                : ''
                                                        "
                                                    />
                                                    <div
                                                        v-if="
                                                            errors.question_file
                                                        "
                                                        class="invalid-feedback mt-2"
                                                    >
                                                        {{
                                                            errors.question_file
                                                        }}
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td
                                                style="width: 20%"
                                                class="fw-bold"
                                            >
                                                Pilihan A
                                            </td>
                                            <td>
                                                <Editor
                                                    api-key="no-api-key"
                                                    v-model="form.option_1"
                                                    :class="
                                                        errors.option_1
                                                            ? 'is-invalid'
                                                            : ''
                                                    "
                                                    :init="editorConfig"
                                                />
                                                <div
                                                    v-if="errors.option_1"
                                                    class="invalid-feedback mt-2"
                                                >
                                                    {{ errors.option_1 }}
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td
                                                style="width: 20%"
                                                class="fw-bold"
                                            >
                                                Pilihan B
                                            </td>
                                            <td>
                                                <Editor
                                                    api-key="no-api-key"
                                                    v-model="form.option_2"
                                                    :class="
                                                        errors.option_2
                                                            ? 'is-invalid'
                                                            : ''
                                                    "
                                                    :init="editorConfig"
                                                />
                                                <div
                                                    v-if="errors.option_2"
                                                    class="invalid-feedback mt-2"
                                                >
                                                    {{ errors.option_2 }}
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td
                                                style="width: 20%"
                                                class="fw-bold"
                                            >
                                                Pilihan C
                                            </td>
                                            <td>
                                                <Editor
                                                    api-key="no-api-key"
                                                    v-model="form.option_3"
                                                    :class="
                                                        errors.option_3
                                                            ? 'is-invalid'
                                                            : ''
                                                    "
                                                    :init="editorConfig"
                                                />
                                                <div
                                                    v-if="errors.option_3"
                                                    class="invalid-feedback mt-2"
                                                >
                                                    {{ errors.option_3 }}
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td
                                                style="width: 20%"
                                                class="fw-bold"
                                            >
                                                Pilihan D
                                            </td>
                                            <td>
                                                <Editor
                                                    api-key="no-api-key"
                                                    v-model="form.option_4"
                                                    :class="
                                                        errors.option_4
                                                            ? 'is-invalid'
                                                            : ''
                                                    "
                                                    :init="editorConfig"
                                                />
                                                <div
                                                    v-if="errors.option_4"
                                                    class="invalid-feedback mt-2"
                                                >
                                                    {{ errors.option_4 }}
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td
                                                style="width: 20%"
                                                class="fw-bold"
                                            >
                                                Pilihan E
                                            </td>
                                            <td>
                                                <Editor
                                                    api-key="no-api-key"
                                                    v-model="form.option_5"
                                                    :class="
                                                        errors.option_5
                                                            ? 'is-invalid'
                                                            : ''
                                                    "
                                                    :init="editorConfig"
                                                />
                                                <div
                                                    v-if="errors.option_5"
                                                    class="invalid-feedback mt-2"
                                                >
                                                    {{ errors.option_5 }}
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td
                                                style="width: 20%"
                                                class="fw-bold"
                                            >
                                                Jawaban Benar
                                            </td>
                                            <td>
                                                <select
                                                    class="form-control"
                                                    v-model="form.answer"
                                                    :class="
                                                        errors.answer
                                                            ? 'is-invalid'
                                                            : ''
                                                    "
                                                >
                                                    <option value="1">A</option>
                                                    <option value="2">B</option>
                                                    <option value="3">C</option>
                                                    <option value="4">D</option>
                                                    <option value="5">E</option>
                                                </select>
                                                <div
                                                    v-if="errors.answer"
                                                    class="invalid-feedback mt-2"
                                                >
                                                    {{ errors.answer }}
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <button
                                type="submit"
                                class="btn btn-md btn-primary border-0 shadow me-2"
                            >
                                Simpan
                            </button>
                            <button
                                type="reset"
                                class="btn btn-md btn-warning border-0 shadow"
                            >
                                Reset
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
//import layout
import LayoutAdmin from '../../../Layouts/Admin.vue'

//import Heade and Link from Inertia
import { Head, Link } from '@inertiajs/inertia-vue3'

//import reactive from vue
import { reactive } from 'vue'

//import inerita adapter
import { Inertia } from '@inertiajs/inertia'

//import sweet alert2
import Swal from 'sweetalert2'

//import tinyMCE
import Editor from '@tinymce/tinymce-vue'

import axios from 'axios'

export default {
    //layout
    layout: LayoutAdmin,

    //register components
    components: {
        Head,
        Link,
        Editor
    },

    //props
    props: {
        errors: Object,
        exam: Object
    },

    data () {
        return {
            editorContent: '',
            editorConfig: {
                plugins: 'lists link image emoticons',
                toolbar:
                    'styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist | link image emoticons',
                // images_upload_url: '/upload-image' // Atur URL endpoint untuk unggah gambar
                images_upload_handler: this.uploadImage
            }
        }
    },

    methods: {
        uploadImage (blobInfo, success, failure) {
            const formData = new FormData()
            formData.append('image', blobInfo.blob(), blobInfo.filename())
            axios
                .post('/admin/exams/questions/upload-image', formData)
                .then(response => {
                    const imageUrl = response.data.location
                    success(imageUrl)
                })
                .catch(error => {
                    console.error(error)
                    failure('Image upload failed')
                })
        }
    },

    //inisialisasi composition API
    setup (props) {
        //define form with reactive
        const form = reactive({
            question_type: 'text',
            question: '',
            question_file: '',
            option_1: '',
            option_2: '',
            option_3: '',
            option_4: '',
            option_5: '',
            answer: ''
        })

        //method "submit"
        const submit = () => {
            //send data to server
            Inertia.post(
                `/admin/exams/${props.exam.id}/questions/store`,
                {
                    //data
                    question_type: form.question_type,
                    question: form.question,
                    question_file: form.question_file,
                    option_1: form.option_1,
                    option_2: form.option_2,
                    option_3: form.option_3,
                    option_4: form.option_4,
                    option_5: form.option_5,
                    answer: form.answer
                },
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
                            title: 'Data berhasil disimpan.'
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
                                title: err.message || 'Data gagal disimpan.'
                            })
                        }
                    }
                }
            )
        }

        //return
        return {
            form,
            submit
        }
    }
}
</script>

<style></style>

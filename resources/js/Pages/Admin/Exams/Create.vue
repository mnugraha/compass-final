<template>
    <Head>
        <title>Tambah Ujian </title>
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
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <h5><i class="fa fa-edit"></i> Tambah Ujian</h5>
                        <hr />
                        <form @submit.prevent="submit">
                            <div class="mb-4">
                                <label>Nama Ujian</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Masukkan Nama Ujian"
                                    v-model="form.title"
                                    :class="errors.title ? 'is-invalid' : ''"
                                />
                                <div
                                    v-if="errors.title"
                                    class="invalid-feedback mt-2"
                                >
                                    {{ errors.title }}
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-4">
                                        <label>Function</label>
                                        <select
                                            class="form-select"
                                            v-model="form.peran_id"
                                            :class="
                                                errors.peran_id
                                                    ? 'is-invalid'
                                                    : ''
                                            "
                                        >
                                            <option
                                                v-for="(peran, index) in peran"
                                                :key="index"
                                                :value="peran?.id_peran"
                                            >
                                                {{ peran?.nm_peran }}
                                            </option>
                                        </select>
                                        <div
                                            v-if="errors.peran_id"
                                            class="invalid-feedback mt-2"
                                        >
                                            {{ errors.peran_id }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-4">
                                        <label>Level</label>
                                        <select
                                            class="form-select"
                                            v-model="form.level_id"
                                            :class="
                                                errors.level_id
                                                    ? 'is-invalid'
                                                    : ''
                                            "
                                        >
                                            <option
                                                v-for="(level, index) in level"
                                                :key="index"
                                                :value="level?.id_level"
                                            >
                                                {{ level?.level }}
                                            </option>
                                        </select>
                                        <div
                                            v-if="errors.level_id"
                                            class="invalid-feedback mt-2"
                                        >
                                            {{ errors.level_id }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-4">
                                        <label>Durasi (Menit)</label>
                                        <input
                                            type="number"
                                            min="1"
                                            class="form-control"
                                            placeholder="Masukkan Durasi Ujian (Menit)"
                                            v-model="form.duration"
                                            :class="
                                                errors.duration
                                                    ? 'is-invalid'
                                                    : ''
                                            "
                                        />
                                        <div
                                            v-if="errors.duration"
                                            class="invalid-feedback mt-2"
                                        >
                                            {{ errors.duration }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-4">
                                        <label class="d-block">Acak Soal</label>
                                        <div
                                            class="form-check form-check-inline"
                                        >
                                            <input
                                                class="form-check-input"
                                                type="radio"
                                                name="radioAcakSoal"
                                                id="radioAcakSoal1"
                                                value="Y"
                                                v-model="form.random_question"
                                            />
                                            <label
                                                class="form-check-label"
                                                for="radioAcakSoal1"
                                            >
                                                Ya
                                            </label>
                                        </div>
                                        <div
                                            class="form-check form-check-inline"
                                        >
                                            <input
                                                class="form-check-input"
                                                type="radio"
                                                name="radioAcakSoal"
                                                id="radioAcakSoal2"
                                                value="N"
                                                v-model="form.random_question"
                                            />
                                            <label
                                                class="form-check-label"
                                                for="radioAcakSoal2"
                                            >
                                                Tidak
                                            </label>
                                        </div>

                                        <div
                                            v-if="errors.random_question"
                                            class="text-danger text-muted small"
                                        >
                                            {{ errors.random_question }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-4">
                                        <label class="d-block"
                                            >Acak Jawaban</label
                                        >
                                        <div
                                            class="form-check form-check-inline"
                                        >
                                            <input
                                                class="form-check-input"
                                                type="radio"
                                                name="random_answer"
                                                id="random_answer1"
                                                value="Y"
                                                v-model="form.random_answer"
                                            />
                                            <label
                                                class="form-check-label"
                                                for="random_answer1"
                                            >
                                                Ya
                                            </label>
                                        </div>
                                        <div
                                            class="form-check form-check-inline"
                                        >
                                            <input
                                                class="form-check-input"
                                                type="radio"
                                                name="random_answer"
                                                id="random_answer"
                                                value="N"
                                                v-model="form.random_answer"
                                            />
                                            <label
                                                class="form-check-label"
                                                for="random_answer"
                                            >
                                                Tidak
                                            </label>
                                        </div>

                                        <div
                                            v-if="errors.random_answer"
                                            class="text-danger text-muted small"
                                        >
                                            {{ errors.random_answer }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-4">
                                        <label class="d-block"
                                            >Tampilkan Hasil
                                        </label>
                                        <div
                                            class="form-check form-check-inline"
                                        >
                                            <input
                                                class="form-check-input"
                                                type="radio"
                                                name="show_answer"
                                                id="show_answer2"
                                                value="Y"
                                                v-model="form.show_answer"
                                            />
                                            <label
                                                class="form-check-label"
                                                for="show_answer2"
                                            >
                                                Ya
                                            </label>
                                        </div>

                                        <div
                                            class="form-check form-check-inline"
                                        >
                                            <input
                                                class="form-check-input"
                                                type="radio"
                                                name="show_answer"
                                                id="show_answer"
                                                value="N"
                                                v-model="form.show_answer"
                                            />
                                            <label
                                                class="form-check-label"
                                                for="show_answer"
                                            >
                                                Tidak
                                            </label>
                                        </div>
                                        <div
                                            v-if="errors.show_answer"
                                            class="text-danger text-muted small"
                                        >
                                            {{ errors.show_answer }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label>Deskripsi</label>
                                <Editor
                                    api-key="no-api-key"
                                    v-model="form.description"
                                    :class="
                                        errors.description ? 'is-invalid' : ''
                                    "
                                    :init="{
                                        menubar: false,
                                        plugins: 'lists link image emoticons',
                                        toolbar:
                                            'styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist | link image emoticons'
                                    }"
                                />
                                <div
                                    v-if="errors.description"
                                    class="invalid-feedback mt-2"
                                >
                                    {{ errors.description }}
                                </div>
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
        peran: Array,
        level: Array
    },

    //inisialisasi composition API
    setup () {
        //define form with reactive
        const form = reactive({
            title: '',
            peran_id: '',
            level_id: '',
            duration: '',
            description: '',
            random_question: '',
            random_answer: '',
            show_answer: ''
        })

        //method "submit"
        const submit = () => {
            //send data to server
            Inertia.post(
                '/admin/exams',
                {
                    //data
                    title: form.title,
                    peran_id: form.peran_id,
                    level_id: form.level_id,
                    duration: form.duration,
                    description: form.description,
                    random_question: form.random_question,
                    random_answer: form.random_answer,
                    show_answer: form.show_answer
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

        return {
            form,
            submit
        }
    }
}
</script>

<style></style>

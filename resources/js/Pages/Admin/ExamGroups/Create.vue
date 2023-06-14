<template>
    <Head>
        <title>Enrolle User</title>
    </Head>
    <div class="container-fluid mb-5 mt-5">
        <div class="row">
            <div class="col-md-12">
                <Link
                    :href="`/admin/exam_sessions/${exam_session?.id}`"
                    class="btn btn-md btn-primary border-0 shadow mb-3"
                    type="button"
                    ><i class="fa fa-long-arrow-alt-left me-2"></i>
                    Kembali</Link
                >

                <div class="row">
                    <div class="col-md-6 col-12 mb-2">
                        <form @submit.prevent="handleSearch">
                            <div class="input-group">
                                <input
                                    type="text"
                                    class="form-control border-0 shadow"
                                    v-model="search"
                                    placeholder="masukkan kata kunci dan enter..."
                                />
                                <span class="input-group-text border-0 shadow">
                                    <i class="fa fa-search"></i>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card border-0 shadow mt-1">
                    <div class="card-body">
                        <h5><i class="fa fa-user-plus"></i> Enrolle User</h5>
                        <hr />
                        <form @submit.prevent="submit">
                            <div class="table-responsive mb-4">
                                <table
                                    class="table table-bordered table-centered table-nowrap mb-0 rounded"
                                >
                                    <thead class="thead-dark">
                                        <tr class="border-0">
                                            <th
                                                class="border-0 rounded-start"
                                                style="width: 5%"
                                            >
                                                <input
                                                    type="checkbox"
                                                    v-model="form.allSelected"
                                                    @change="selectAll"
                                                />
                                            </th>
                                            <th class="border-0">ID USER</th>
                                            <th class="border-0">Nama</th>
                                            <th class="border-0">Function</th>
                                            <th class="border-0">Level</th>
                                        </tr>
                                    </thead>
                                    <div class="mt-3"></div>
                                    <tbody>
                                        <tr
                                            v-for="user of users?.data"
                                            :key="user.id"
                                        >
                                            <td>
                                                <input
                                                    type="checkbox"
                                                    v-model="form.user_id"
                                                    :id="user?.id_user"
                                                    :value="user?.id_user"
                                                    number
                                                    :checked="form.allSelected"
                                                />
                                            </td>
                                            <td>{{ user?.id_user }}</td>
                                            <td>{{ user?.name }}</td>
                                            <td class="text-center">
                                                {{ user?.peran?.nm_peran }}
                                            </td>
                                            <td class="text-center">
                                                {{ user?.level?.level }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div
                                    v-if="errors.user_id"
                                    class="alert alert-danger mt-2"
                                >
                                    {{ errors.user_id }}
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

                            <Pagination
                                :links="users?.links"
                                :show="users?.per_page"
                                :total="users?.total"
                                align="end"
                            />
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
        Link,
        Pagination
    },

    //props
    props: {
        errors: Object,
        exam: Object,
        exam_session: Object,
        users: Array
    },

    //inisialisasi composition API
    setup (props) {
        //define form with reactive
        const form = reactive({
            exam_id: props.exam.id,
            user_id: [],
            allSelected: false
        })

        //define method "selectAll"
        const selectAll = () => {
            if (form.allSelected) {
                form.user_id = props.users.data.map(user => user.id_user)
            } else {
                form.user_id = []
            }
        }

        //define state search
        const search = ref(
            '' || new URL(document.location).searchParams.get('q')
        )

        //define method search
        const handleSearch = () => {
            Inertia.get(
                `/admin/exam_sessions/${props.exam_session.id}/enrolle/create`,
                {
                    //send params "q" with value from state "search"
                    q: search.value
                }
            )
        }

        //method "submit"
        const submit = () => {
            //send data to server
            Inertia.post(
                `/admin/exam_sessions/${props.exam_session.id}/enrolle/store`,
                {
                    //data
                    exam_id: form.exam_id,
                    user_id: form.user_id
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
            selectAll,
            submit,
            search,
            handleSearch
        }
    }
}
</script>

<style></style>

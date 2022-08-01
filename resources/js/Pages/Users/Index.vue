<template>
    <Head title="Users" />
    <FlashMessages />
    <div class="container-xl">
        <!-- Page title -->
        <div class="page-header d-print-none">
            <div class="row align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">Admin</div>
                    <h2 class="page-title">Pengguna</h2>
                </div>
                <!-- Page title actions -->
                <!-- <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <span class="d-none d-sm-inline">
                            <a href="#" class="btn btn-white"> New view </a>
                        </span>
                        <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modal-report">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <line x1="12" y1="5" x2="12" y2="19" />
                                <line x1="5" y1="12" x2="19" y2="12" />
                            </svg>
                            Create new report
                        </a>
                        <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal" data-bs-target="#modal-report" aria-label="Create new report">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <line x1="12" y1="5" x2="12" y2="19" />
                                <line x1="5" y1="12" x2="19" y2="12" />
                            </svg>
                        </a>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
    <!-- <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 shadow rounded-lg overflow-x-auto"> -->
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr>
                            <th scope="col" class="px-5 py-3 bg-white border-b border-gray-200 text-gray-800 text-left text-sm uppercase font-normal">User</th>
                            <th scope="col" class="px-5 py-3 bg-white border-b border-gray-200 text-gray-800 text-left text-sm uppercase font-normal">Email</th>

                            <th scope="col" class="px-5 py-3 bg-white border-b border-gray-200 text-gray-800 text-left text-sm uppercase font-normal">Role</th>
                            <th scope="col" class="px-5 py-3 bg-white border-b border-gray-200 text-gray-800 text-left text-sm uppercase font-normal">Date Joint</th>
                            <th scope="col" class="px-5 py-3 bg-white border-b border-gray-200 text-gray-800 text-left text-sm uppercase font-normal">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="user in users.data" :key="user.id">
                            <td class="mr-5 px-5 py-3 border-b border-gray-200 bg-white text-sm">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        <a href="#" class="block relative">
                                            <img alt="profil" v-bind:src="'https://i.pravatar.cc/150?u=' + user.avatar" class="mx-auto object-cover rounded-full h-10 w-10" />
                                        </a>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-gray-900 whitespace-no-wrap">
                                            {{ user.name }}
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-3 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-900 whitespace-no-wrap">
                                    {{ user.email }}
                                </p>
                            </td>
                            <td class="px-5 py-3 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-900 whitespace-no-wrap">
                                    {{ user.role }}
                                </p>
                            </td>

                            <td class="px-5 py-3 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-900 whitespace-no-wrap">12/09/2020</p>
                            </td>
                            <td class="px-5 py-3 border-b border-gray-200 bg-white text-sm">
                                <div v-if="$page.props.auth.user.permissions.includes('update.user')">
                                    <Link :href="`/users/${user.id}/edit`" class="text-indigo-600 hover:text-indigo-900"> Edit</Link>
                                </div>
                            </td>
                        </tr>
                        <tr v-if="users.length === 0">
                            <td class="px-6 py-4 border-t" colspan="4">No users found.</td>
                        </tr>
                    </tbody>
                </table>
                <Pagination :links="users.links" class="pl-2 my-6 items-center" />
            </div>
        </div>
    </div>
</template>

<script setup>
import Pagination from '../../Shared/Pagination'
import FlashMessages from '../../Shared/FlashMessages'
import { ref, watch } from 'vue'
import { Inertia } from '@inertiajs/inertia'
import debounce from 'lodash/debounce'

let props = defineProps({
    users: Object,
    filters: Object,
    can: Object,
})

let search = ref(props.filters.search)

watch(
    search,
    debounce(function (value) {
        Inertia.get('/users', { search: value }, { preserveState: true, replace: true })
    }, 300),
)
</script>

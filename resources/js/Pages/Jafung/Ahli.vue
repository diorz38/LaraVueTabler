<template>
    <div>
        <div class="container-xl">
            <!-- Page title -->
            <div class="page-header d-print-none">
                <div class="row align-items-center">
                    <div class="col">
                        <!-- Page pre-title -->
                        <div class="page-pretitle">Overview</div>
                        <h2 class="page-title">Dashboard</h2>
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
        <FlashMessages />
        <div class="page-body">
            <div class="container-xl">
                <div class="row row-deck row-cards">
                    <div class="col-12">
                        <div class="card">
                            <!-- <div class="card-header">
                            <h3 class="card-title">Invoices</h3>
                        </div> -->
                            <div class="card-body border-bottom py-3">
                                <div class="d-flex">
                                    <div class="text-muted">
                                        Show
                                        <div class="mx-2 d-inline-block">
                                            <input type="text" class="form-control form-control-sm" value="8" size="3" aria-label="Invoices count" />
                                        </div>
                                        entries
                                    </div>

                                    <div class="ms-auto text-muted">
                                        <div class="input-group mb-2">
                                            <div class="dropdown">
                                                <button type="button" class="btn dropdown-toggle btn-sm" data-bs-toggle="dropdown" aria-expanded="false">Filter</button>
                                                <div class="dropdown-menu" style="">
                                                    <a class="dropdown-item" href="javascript:void(0)"> Action </a>
                                                    <a class="dropdown-item" href="javascript:void(0)"> Another action </a>
                                                </div>
                                            </div>
                                            <input v-model="search" type="text" class="form-control form-control-sm" aria-label="Search invoice" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table card-table table-vcenter text-nowrap datatable">
                                    <thead>
                                        <tr>
                                            <th class="w-1"><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select all invoices" /></th>
                                            <th class="w-1">Butir<ChevronUpIcon class="icon icon-sm text-dark icon-thick" /></th>
                                            <th>Uraian Kegiatan</th>
                                            <th>Output</th>
                                            <th>Angka<br />Kredit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="item in jafungs.data" :key="item.id">
                                            <td><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select invoice" /></td>
                                            <td>
                                                <span class="text-muted">{{ item.butir }}</span>
                                            </td>
                                            <td>
                                                <div class="col">
                                                    <div class="badge bg-cyan-lt mb-1 text-sm tracking-tight">{{ item.unsur }}</div>
                                                    <div>
                                                        <Link :href="route('jafung.show', item.id)" class="text-wrap text-reset">{{ item.uraian_kegiatan }}</Link>
                                                    </div>
                                                    <div class="badge bg-lime-lt text-sm tracking-tight">{{ item.sub_unsur }}</div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="col">
                                                    <div class="text-wrap">{{ item.output }}</div>
                                                    <div class="badge bg-purple-lt">{{ item.pelaksana }}</div>
                                                </div>
                                            </td>
                                            <td>{{ item.angka_kredit }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="card-footer d-flex align-items-start">
                                    <Pagination :links="jafungs.links" class="my-4 mx-4" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
import { ChevronUpIcon } from 'vue-tabler-icons'

let props = defineProps({
    jafungs: Object,
    filters: Object,
})

let search = ref(props.filters.search)

watch(
    search,
    debounce(function (value) {
        Inertia.get('/jafungs/ahli', { search: value }, { preserveState: true, replace: true })
    }, 300),
)
</script>

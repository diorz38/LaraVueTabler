<template>
    <div>
        <div class="container-xl">
            <FlashMessages />
            <!-- Page title -->
            <div class="page-header d-print-none">
                <div class="row align-items-center">
                    <div class="col">
                        <!-- Page pre-title -->
                        <div class="page-pretitle">{{ jafung.jafung }} {{ jafung.klasifikasi }}</div>
                        <h2 class="page-title">{{ jafung.no }} {{ jafung.unsur }}</h2>
                    </div>
                    <!-- Page title actions -->
                    <div class="col-auto ms-auto d-print-none">
                        <div class="btn-list">
                            <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modal-report">
                                <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <line x1="12" y1="5" x2="12" y2="19" />
                                    <line x1="5" y1="12" x2="19" y2="12" />
                                </svg>
                                Upload Bahan Bukti
                            </a>
                            <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal" data-bs-target="#modal-report" aria-label="Create new report">
                                <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <line x1="12" y1="5" x2="12" y2="19" />
                                    <line x1="5" y1="12" x2="19" y2="12" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-body">
            <div class="container-xl">
                <div class="row row-cards">
                    <div class="col-lg-8">
                        <div class="card card-lg">
                            <div class="card-body">
                                <div class="markdown">
                                    <h2>{{ jafung.no }}{{ jafung.no_keg }}. {{ jafung.sub_unsur }}</h2>
                                    <p>{{ jafung.uraian_kegiatan }}</p>
                                    <p><b>OUTPUT:</b> {{ jafung.output }}</p>

                                    <div v-for="(deskripsi_keg, index) in deskripsi_kegs" :key="index">
                                        <div v-if="index === 0">
                                            <p><span class="badge bg-indigo text-lg">{{ jafung.butir }}</span>
                                            {{ deskripsi_keg }}</p>
                                        </div>
                                        <div v-else>
                                            <ul>
                                                <li>{{ deskripsi_keg }}</li>
                                            </ul>
                                        </div>
                                    </div>

                                    <!-- <p>Restrictions</p>
                                    <ol>
                                        <li>You do not have the rights to redistribute, resell, lease, license, sub-license or offer the file downloaded to any third party.</li>
                                        <li>For any resalable web applications or software programs, you cannot include our graphic resources as an additional attachment.</li>
                                        <li>You cannot redistribute any of the software, or products created with Tabler paid products.</li>
                                        <li>You cannot add our source code to any open source repository.</li>
                                        <li>The source code may not be placed on any website in a complete or archived downloadable format.</li>
                                    </ol> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="me-3">
                                        <div class="avatar bg-indigo-lt">AK</div>
                                    </div>
                                    <div>
                                        <div class="avatar bg-lime text-white">{{ jafung.angka_kredit }}</div>
                                    </div>
                                </div>
                                <h4>Batasan</h4>
                                <div class="text-muted mb-3">{{ jafung.batasan }}</div>
                                <h4>Bukti Fisik</h4>
                                <div v-for="(item, index) in bukti" :key="index">
                                    <div v-if="index === 0" class="text-muted mb-3">
                                        {{ item }}
                                    </div>
                                    <div v-else>
                                        <ul class="list-unstyled space-y-1">
                                            <li>
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon text-green" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M5 12l5 5l10 -10" />
                                                </svg>
                                                {{ item }}
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon text-blue" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <circle cx="12" cy="12" r="9" />
                                    <line x1="12" y1="8" x2="12.01" y2="8" />
                                    <polyline points="11 12 12 12 12 16 13 16" />
                                </svg>
                                Sumber: Juknis Pranata Komputer Tahun 2020
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

let props = defineProps({
    jafungs: Object,
    dekripsiKeg: Object,
    buktiFisik: Object,
})

let jafung = ref(props.jafungs)
let deskripsi_kegs = ref(props.dekripsiKeg)
let bukti = ref(props.buktiFisik)
</script>

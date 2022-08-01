<template>
    <div>
        <Head title="Create User" />
        <div class="container-xl">
            <!-- Page title -->
            <div class="page-header d-print-none">
                <div class="row align-items-center">
                    <div class="col">
                        <!-- Page pre-title -->
                        <div class="page-pretitle">Pengguna</div>
                        <h2 class="page-title">Update</h2>
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
        <div class="page-body">
            <div class="container-xl">
                <form @submit.prevent="submit(props.user.id)" class="max-w-md mx-auto mt-8">
                    <div class="mb-6">
                        <input v-model="form.id" type="hidden" name="id" id="id" />
                        <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="name"> Name </label>

                        <input v-model="form.name" class="border border-gray-400 p-2 w-full" type="text" name="name" id="name" required />
                        <div v-if="form.errors.name" v-text="form.errors.name" class="text-red-500 text-xs mt-1"></div>
                    </div>

                    <div class="mb-6">
                        <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="email"> Email </label>

                        <input v-model="form.email" class="border border-gray-400 p-2 w-full" type="email" name="email" id="email" required />

                        <div v-if="form.errors.email" v-text="form.errors.email" class="text-red-500 text-xs mt-1"></div>
                    </div>

                    <!-- <div class="mb-6">
      <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="password"> Password </label>

      <input
        v-model="form.password"
        class="border border-gray-400 p-2 w-full"
        type="password"
        name="password"
        id="password"
      />

      <div v-if="form.errors.password" v-text="form.errors.password" class="text-red-500 text-xs mt-1"></div>
    </div> -->

                    <div class="mb-6">
                        <button type="submit" class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500" :disabled="form.processing">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
<script setup>
import { useForm } from '@inertiajs/inertia-vue3'

let props = defineProps({
    user: Object,
})

let form = useForm({
    _method: 'put',
    id: props.user.id,
    name: props.user.name,
    email: props.user.email,
})

let submit = () => {
    form.post('/user')
}
</script>

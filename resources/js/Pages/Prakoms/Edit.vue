<template>
    <div>
        <h1 class="mb-8 font-bold text-3xl">
            <inertia-link class="text-indigo-400 hover:text-indigo-600" :href="route('prakoms')">Prakoms</inertia-link>
            <span class="text-indigo-400 font-medium"> / </span>{{ form.title }}
        </h1>
        <trashed-message v-if="prakom.deleted_at" class="mb-6" @restore="restore">
            This prakom has been deleted.
        </trashed-message>
        <div class="bg-white rounded-md shadow overflow-hidden max-w-3xl">
            <form @submit.prevent="update">
                <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
                    <div>
                        <label class="form-label" for="text-input-title">Title:</label>
                        <input v-model="form.title" id="text-input-title" ref="input" class="form-input" type="text" />
                    </div>
                </div>
                <div class="px-8 py-4 bg-gray-50 border-t border-gray-100 flex items-center">
                    <button v-if="!prakom.deleted_at" class="text-red-600 hover:underline" tabindex="-1" type="button" @click="destroy">Delete Prakom</button>
                    <button :disabled="loading" class="flex items-center px-6 py-3 rounded bg-indigo-600 text-white text-sm leading-4 font-bold whitespace-nowrap hover:bg-orange-400 focus:bg-orange-400 ml-auto" type="submit">
                      Update Prakom
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import Layout from '@/Shared/Layout'

export default {
    layout: Layout,
    metaInfo() {
        return { title: this.form.title }
    },
    props: {
        prakom: Object,
    },
    remember: 'form',
    data() {
        return {
            form: this.$inertia.form({
                name: this.prakom.title,
            }),
        }
    },
    methods: {
        update() {
            this.form.put(this.route('prakoms.update', this.prakom.id))
        },
        destroy() {
            if (confirm('Are you sure you want to delete this prakom?')) {
                this.$inertia.delete(this.route('prakoms.destroy', this.prakom.id))
            }
        },
        restore() {
            if (confirm('Are you sure you want to restore this prakom?')) {
                this.$inertia.put(this.route('prakoms.restore', this.prakom.id))
            }
        },
    },
}
</script>

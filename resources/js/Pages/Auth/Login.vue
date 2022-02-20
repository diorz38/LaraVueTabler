<template>
    <div class="antialiased border-top-wide border-primary d-flex flex-column">
        <div class="page page-center">
            <div class="container-tight py-4">
                <form @submit.prevent="submit" class="card card-md" autocomplete="off">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-4">Login to your account</h2>
                        <div class="mb-3">
                            <label class="form-label">Email address</label>
                            <input v-model="form.email" type="email" name="email" id="email" required class="form-control" placeholder="Enter email" />
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Password</label>
                            <div class="input-group input-group-flat">
                                <input v-model="form.password" type="password" name="password" id="password" class="form-control" placeholder="Password" autocomplete="off" />
                            </div>
                        </div>
                        <div class="form-footer">
                            <button type="submit" class="btn btn-primary w-100">Sign in</button>
                        </div>
                    </div>
                    <div class="hr-text mb-3">BPS PROV JAWA BARAT</div>
                </form>
                <!-- <div class="text-center text-muted mt-3">
                    Don't have account yet?
                    <a href="./sign-up.html" tabindex="-1">Sign up</a>
                </div> -->
            </div>
        </div>
    </div>
    <!-- <Head title="Log In" />

  <main class="grid place-items-center min-h-screen">
    <section class="bg-white p-8 rounded-xl max-w-md mx-auto border w-full">
      <h1 class="text-3xl mb-6">Log In</h1>

      <form @submit.prevent="submit">
        <div class="mb-6">
          <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="email"> Email </label>

          <input v-model="form.email" class="border p-2 w-full rounded" type="email" name="email" id="email" required />

          <div v-if="form.errors.email" v-text="form.errors.email" class="text-red-500 text-xs mt-1"></div>
        </div>

        <div class="mb-6">
          <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="password"> Password </label>

          <input v-model="form.password" class="border p-2 w-full rounded" type="password" name="password" id="password" />

          <div v-if="form.errors.password" v-text="form.errors.password" class="text-red-500 text-xs mt-1"></div>
        </div>

        <div>
          <button type="submit" class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500" :disabled="form.processing">Log In</button>
        </div>
      </form>
    </section>
  </main> -->
</template>

<script>
export default {
    layout: null,
}
</script>

<script setup>
import { useForm } from '@inertiajs/inertia-vue3'

let form = useForm({
    email: '',
    password: '',
})

let submit = () => {
    console.log(form)
    form.post(route('login.store'))
}
</script>

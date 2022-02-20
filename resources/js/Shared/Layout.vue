<template>
    <Head>
        <meta type="description" content="Information about my app" head-key="description" />
    </Head>
    <Nav />
    <div class="page-wrapper">
        <slot />
    </div>
    <footer class="footer footer-transparent d-print-none">
        <div class="container">
            <div class="row text-center align-items-center flex-row-reverse">
                <div class="col-lg-auto ms-lg-auto">
                    <!-- <ul class="list-inline list-inline-dots mb-0"> -->
                    <ul class="list-inline list-inline-dots mb-0">
                        <li class="list-inline-item"><a href="#php" class="link-info">{{ $page.props.appInfo.phpVersion }}</a></li>
                        <li class="list-inline-item"><a href="#laravel" class="link-info">{{ $page.props.appInfo.laravelVersion }}</a></li>
                        <li class="list-inline-item"><a href="#vue" class="link-info" rel="noopener">{{ $page.props.appInfo.vueVersion }}</a></li>
                        <li class="list-inline-item"><a href="#inertia" class="link-info" rel="noopener">{{ $page.props.appInfo.inertiaVersion }}</a></li>
                        <li class="list-inline-item"><a href="#tabler" class="link-info" rel="noopener">{{ $page.props.appInfo.tablerVersion }}</a></li>
                    </ul>
                </div>
                <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                    <ul class="list-inline list-inline-dots mb-0">
                        <li class="list-inline-item">
                            Made with <span><HeartIcon class="icon text-pink icon-filled icon-inline"/><CopyrightIcon class="icon text-info icon-inline"/></span> 2021
                            <a href="https://github.com/diorz38/LaraVueTabler/tree/Backend-v2.0" target="_blank" class="link-secondary" rel="noopener">LaraVueTabler.</a> All rights reserved.
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</template>

<script>
import Nav from './Nav'
import { HeartIcon, CopyrightIcon } from 'vue-tabler-icons'

export default {
    components: { Nav,HeartIcon,CopyrightIcon },

    computed: {
        name() {
            return this.$page.props.auth.user.name
        },
        email() {
            return this.$page.props.auth.user.email
        },
    },
}
</script>

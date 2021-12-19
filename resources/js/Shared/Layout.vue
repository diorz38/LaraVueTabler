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
                        <!-- Download SVG icon from http://tabler-icons.io/i/heart -->

                        <!-- <li class="list-inline-item">
                            <a href="https://github.com/sponsors/codecalm" target="_blank" class="link-secondary" rel="noopener">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon text-pink icon-filled icon-inline" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M19.5 13.572l-7.5 7.428l-7.5 -7.428m0 0a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572" />
                                </svg>
                                Sponsor
                            </a>
                        </li> -->
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

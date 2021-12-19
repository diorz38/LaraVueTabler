<template>
    <div>
        <header class="navbar navbar-expand-md navbar-light d-print-none">
            <div class="container-xl">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <Link :href="route('home')" class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal">
                    <img :src="getLogo()" height="42">
                    <span class="text-reset"> Jafung</span>
                </Link>

                <div class="navbar-nav flex-row order-md-last">
                    <div class="nav-item dropdown d-none d-md-flex me-3">
                        <a href="#" class="nav-link px-0" data-bs-toggle="dropdown" tabindex="-1" aria-label="Show notifications">
                            <BellIcon />
                            <span class="badge bg-red"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-card">
                            <div class="card">
                                <div class="card-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus ad amet consectetur exercitationem fugiat in ipsa ipsum, natus odio quidem quod repudiandae sapiente. Amet debitis et magni maxime necessitatibus ullam.</div>
                            </div>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
                            <span class="avatar avatar-sm" :style="{'background-image':'url('+avatar+')'}"></span>
                            <div class="d-none d-xl-block ps-2">
                                <div>{{ nama }}</div>
                                <div class="mt-1 small text-muted">{{ email }}</div>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <a href="#" class="dropdown-item">Set status</a>
                            <a href="#" class="dropdown-item">Profile & account</a>
                            <a href="#" class="dropdown-item">Feedback</a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">Settings</a>
                            <form @submit.prevent="submit">
                                <button type="submit" class="dropdown-item">Logout</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <div class="navbar-expand-md">
            <div class="collapse navbar-collapse" id="navbar-menu">
                <div class="navbar navbar-light">
                    <div class="container-xl">
                        <ul class="navbar-nav">
                            <NavLink :href="route('dashboard')" :active="$page.component === 'Dashboard'" class="nav-item">
                                <span class="nav-link-icon d-md-none d-lg-inline-block">
                                    <HomeIcon />
                                </span>
                                <span class="nav-link-title"> Dashboard </span>
                            </NavLink>
                            <NavDrop :active="$page.component === 'Jafung/Index'" class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" role="button" cursor="pointer" aria-expanded="false">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <BoxIcon />
                                    </span>
                                    <span class="nav-link-title"> Prakom </span>
                                </a>
                                <div class="dropdown-menu">
                                    <div class="dropdown-menu-columns">
                                        <div class="dropdown-menu-column">
                                            <NavLinkDrop :href="route('jafung.index', 'ahli')" cursor="pointer" class="dropdown-item" :active="$page.url === '/jafungs/ahli'"> Ahli </NavLinkDrop>
                                            <NavLinkDrop :href="route('jafung.index', 'terampil')" cursor="pointer" class="dropdown-item" :active="$page.url === '/jafungs/terampil'"> Terampil </NavLinkDrop>
                                        </div>
                                    </div>
                                </div>
                            </NavDrop>
                            <NavLink href="/docs" :active="$page.component === 'Docs'">
                                <span class="nav-link-icon d-md-none d-lg-inline-block">
                                    <NotebookIcon />
                                </span>
                                <span class="nav-link-title"> Documentation </span>
                            </NavLink>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import NavLink from './NavLink'
import NavLinkDrop from './NavLinkDrop'
import NavDrop from './NavDrop'
import { HomeIcon,BoxIcon,SearchIcon,NotebookIcon,BrandTablerIcon,BellIcon } from "vue-tabler-icons"

export default {
    components: { NavLink, NavLinkDrop, NavDrop, HomeIcon, BoxIcon, SearchIcon, NotebookIcon, BrandTablerIcon,BellIcon },
    computed: {
        nama() {
            return this.$page.props.auth.user.name
        },
        email() {
            return this.$page.props.auth.user.email
        },
        avatar() {
            return this.$page.props.auth.user.avatar
        },
    },
    methods: {
        submit() {
            this.$inertia.post('/logout')
        },
        getLogo() {
            return 'http://127.0.0.1:8000/static/smartkit_logo.png';
        }
    },
}
</script>

<template>
    <li class="nav-item" :class="{ 'nav-item active': active }">
        <Link class="nav-link"><slot /></Link>
    </li>
</template>

<script>
export default {
    props: {
        active: Boolean,
    },
}
</script>

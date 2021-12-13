<template>
    <Link class="dropdown-item" :class="{ 'nav-item active': active }"><slot /></Link>
</template>

<script>
export default {
    props: {
        active: Boolean,
    },
}
</script>

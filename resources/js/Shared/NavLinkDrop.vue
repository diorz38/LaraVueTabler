<template>
    <Link class="dropdown-item" :class="{ 'dropdown-item active': active }"><slot /></Link>
</template>

<script>
export default {
    props: {
        active: Boolean,
    },
}
</script>

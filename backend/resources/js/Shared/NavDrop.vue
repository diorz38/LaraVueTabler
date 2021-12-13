<template>
    <li class="nav-item dropdown" :class="{ 'nav-item dropdown active': active }"><slot /></li>
</template>

<script>
export default {
    props: {
        active: Boolean,
    },
}
</script>

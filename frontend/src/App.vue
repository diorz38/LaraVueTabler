<script setup>
// This starter template is using Vue 3 <script setup> SFCs
// Check out https://v3.vuejs.org/api/sfc-script-setup.html#sfc-script-setup
import HelloWorld from "./components/HelloWorld.vue";
import Header from "./components/Header.vue";
import NavBar from "./components/NavBar.vue";
</script>

<template>
  <div class="wrapper">
    <Header />
    <NavBar />
    <HelloWorld msg="Hello Vue 3 + Vite + Tabler" />
  </div>
  <!-- <img alt="Vue logo" src="./assets/logo.png" /> -->
</template>

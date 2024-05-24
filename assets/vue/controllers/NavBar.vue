<script setup>
import NavItem from "../components/atom/NavItem.vue";
import {Collapse} from "bootstrap";

const props = defineProps({
  navigation: {type: Object, required: true}
})

</script>

<template>
  <nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
      <a class="navbar-brand fs-4 fw-bold" href="/">
        <span class="text-primary">augusta</span>
        <span class="text-info">.</span>
        <span class="text-primary">sarlin</span>
      </a>
      <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mb-2 mb-lg-0 justify-content-end d-flex align-items-center w-100">
          <li v-for="(link, index) in navigation" :key="index" class="nav-item">
            <div class="py-1 px-5">
              <NavItem
                  :label="link.label"
                  :value="link.link"
                  color-class="secondary"
                  size="lg"
              />
            </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</template>

<style scoped>

</style>
<script setup>
import NavItem from "./NavItemDesktop.vue";
import {Collapse} from "bootstrap";

const props = defineProps({
  navigation: {type: Object, required: true}
})
</script>

<template>
  <nav class="navbar navbar-expand-md">
    <div class="container-fluid">
      <a class="navbar-brand fs-4 fw-bold d-md-none d-inline" href="/">
        <span class="text-primary">augusta</span>
        <span class="text-info">.</span>
        <span class="text-primary">sarlin</span>
      </a>
      <button
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
          class="navbar-toggler"
          data-bs-target="#navbarSupportedContent"
          data-bs-toggle="collapse"
          type="button"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div id="navbarSupportedContent" class="collapse navbar-collapse">
        <ul class="navbar-nav mb-2 mb-lg-0 justify-content-end d-flex align-items-center w-100">
          <li v-for="(link, index) in navigation" :key="index" class="nav-item">
            <div class="py-1 px-5">
              <NavItem
                  :label="link.label"
                  :value="link.link"
                  class="cursor-pointer"
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
.cursor-pointer {
  cursor: url("../../../../public/build/media/misc/pointer.webp"), pointer;
}

</style>
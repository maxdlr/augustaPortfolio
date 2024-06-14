<script setup>
import NavItem from "./NavItemDesktop.vue";
import SocialItem from "./SocialItem.vue";

const props = defineProps({
  navigation: {type: Object, required: true},
  socialItems: {type: Object, required: true}
})
</script>

<template>
  <nav class="navbar navbar-expand-md">
    <div class="container-fluid">
      <a class="navbar-brand fs-4 fw-bold d-lg-none d-inline" href="/">
        <span class="text-primary">augusta</span>
        <span class="text-info">.</span>
        <span class="text-primary">sarlin</span>
      </a>
      <div
          class="d-flex flex-lg-row flex-column justify-content-lg-between justify-content-center align-items-center w-100">
        <ul class="list-unstyled justify-content-start d-flex align-items-center">
          <li v-for="(link, index) in navigation" :key="index" class="nav-item">
            <div class="py-1 px-4">
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
        <ul class="list-unstyled justify-content-end d-flex align-items-center">
          <li v-for="socialItem in socialItems" class="mx-1">
            <SocialItem :social-item="socialItem"/>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</template>
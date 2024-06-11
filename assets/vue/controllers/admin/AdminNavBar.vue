<script setup>
import AdminNavItem from "../../components/atom/AdminNavItem.vue";

const props = defineProps({
  navigation: {type: Object, required: true}
})

const isCurrentLocation = (link) => {
  return window.location.pathname === link
}

</script>

<template>
  <ul class="nav nav-pills d-flex flex-md-column justify-content-start align-items-start p-md-5 ps-0">
    <li v-for="(link, index) in navigation" :key="index" class="nav-item">
      <div class="py-1">
        <AdminNavItem
            :color-class="isCurrentLocation(link.link) ? 'primary' : 'outline-primary'"
            :label="link.label"
            :value="link.link"
        />
      </div>
    </li>
  </ul>
  <div class="w-100 bg-info-subtle my-3 d-block d-md-none" style="height: 2px !important;"></div>
</template>
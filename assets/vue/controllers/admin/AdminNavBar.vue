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
  <ul class="nav nav-pills d-flex flex-column justify-content-start align-items-start p-5 ps-0">
    <li v-for="(link, index) in navigation" :key="index" class="nav-item">
      <div class="py-1">
        <AdminNavItem
            :label="link.label"
            :value="link.link"
            :color-class="isCurrentLocation(link.link) ? 'primary' : 'outline-primary'"
        />
      </div>
    </li>
  </ul>
</template>

<style scoped>

</style>
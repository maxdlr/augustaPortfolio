<script setup>
import CVItem from "../atom/CVItem.vue";

const props = defineProps({
  items: {type: Object},
  title: {type: String, required: true}
})
</script>

<template>
  <div class="w-100 my-3">
    <h2 class="fs-1 fs-title text-info mb-4">
      {{ title }}
    </h2>
    <div v-for="item in items" :key="item.id">
      <CVItem :item="item" hover-action/>
    </div>
  </div>
</template>

<style scoped>

</style>
<script setup>
import BaseTemplate from "../atom/BaseTemplate.vue";

const props = defineProps({
  showreelThumbnailPath: {type: String, required: false}
})
</script>

<template>
  <div id="showreel"></div>
  <BaseTemplate>
    <template #context>
      <div class="fs-1">
        <div>
          <span class="text-secondary">Freelance</span>
        </div>
        <div>
          <span class="text-info">motion designer</span>
          <span class="text-secondary"> & </span>
          <span class="text-primary">illustrator</span>
        </div>
        <div>
          <span class="text-secondary">based in Lyon, France</span>
        </div>
      </div>
    </template>

    <template #content>
      <div class="rounded-4 overflow-hidden">
        <img class="img-fluid" :src="showreelThumbnailPath" alt="Augusta Sarlin's showreel thumbnail">
      </div>
    </template>

  </BaseTemplate>
</template>

<style scoped>

</style>
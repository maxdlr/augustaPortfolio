<script setup>
import BaseTemplate from "../atom/BaseTemplate.vue";

const props = defineProps({
  motionGifs: {type: Object, required: true}
})

const site = window.location.origin;

</script>

<template>
<BaseTemplate>
  <template #context>
    <div class="fs-1">
      <div>
        <span class="text-secondary">Creative Lab</span>
        <span class="text-info">.</span>
      </div>
      <div>
        <span class="text-info">2D & </span>
        <span class="text-primary">character animation</span>
      </div>
    </div>
  </template>
  <template #content>
    <div class="row row-cols-3 my-4">
      <div v-for="(gif, index) in motionGifs" :key="index" class="p-1">
        <img :src="`${site}/build/media/motion/${gif.mediaPath}`" :alt="gif.mediaPath" class="w-100 object-fit-cover border rounded-4" style="aspect-ratio: 1/1 !important;">
      </div>
    </div>
  </template>
</BaseTemplate>
</template>

<style scoped>

</style>
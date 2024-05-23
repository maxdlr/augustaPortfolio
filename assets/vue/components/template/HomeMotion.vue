<script setup>
import BaseTemplate from "../atom/BaseTemplate.vue";
import MediaGallery from "../molecule/MediaGallery.vue";

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
    <MediaGallery :medias="motionGifs" col-count="3"/>
  </template>
</BaseTemplate>
</template>

<style scoped>

</style>
<script setup>
import BaseTemplate from "../atom/BaseTemplate.vue";
import MediaGallery from "../molecule/MediaGallery.vue";
import {BREAKPOINTS} from "../../constant/bootstrap-constants";

const props = defineProps({
  motionGifs: {type: Object, required: true},
  anchor: {type: String, required: true}
})

const site = window.location.origin;

</script>

<template>
  <BaseTemplate :anchor="anchor">
    <template #context="{screenWidth, screenHeight}">
      <div class="fs-1">
        <div>
          <span class="text-secondary">Creative Lab</span>
          <span class="text-info">.</span>
        </div>
        <div>
          <span class="text-info">2D </span>
          <span class="text-secondary">& </span>
          <span class="text-primary">character animation</span>
        </div>
      </div>
    </template>
    <template #content="{screenWidth, screenHeight}">
      <MediaGallery
          :is-on-mobile="screenWidth < BREAKPOINTS.MD"
          :medias="motionGifs"
          col-count="3"
          gallery-name="homeMotion"
      />
    </template>
  </BaseTemplate>
</template>

<style scoped>

</style>
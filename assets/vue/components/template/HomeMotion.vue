<script setup>
import HomeGalleryTemplate from "../molecule/HomeGalleryTemplate.vue";

const props = defineProps({
  motionGifs: {type: Object, required: true},
  anchor: {type: String, required: true}
})
</script>

<template>
  <HomeGalleryTemplate
      :anchor="anchor"
      :media="motionGifs"
      gallery-name="homeMotion">

    <template #title>
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

  </HomeGalleryTemplate>
</template>

<style scoped>

</style>
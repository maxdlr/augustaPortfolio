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
      :medias="motionGifs"
      gallery-name="homeMotion"
      lazy-load-trigger="hover"
  >
    <template #title>
      <article class="fs-1">
        <div>
          <span class="text-secondary">Creative Lab</span>
          <span class="text-info">.</span>
        </div>
        <div>
          <span class="text-info">2D </span>
          <span class="text-secondary">& </span>
          <span class="text-primary">character animation</span>
        </div>
      </article>
    </template>
  </HomeGalleryTemplate>
</template>

<style lang="scss" scoped>

</style>
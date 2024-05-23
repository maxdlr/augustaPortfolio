<script setup>
import MediaThumbnail from "../atom/MediaThumbnail.vue";

const props = defineProps({
  medias: {type: Object, required: true},
  colCount: {type: [Number, String], default: 4, required: false},
  lazyLoadTrigger: {type: [String, Boolean], default: null, required: false, validator(value) {
      return ['hover', 'click', false].includes(value)
    }}
})
const site = window.location.origin;



</script>

<template>
  <section class="row my-4" :class="`row-cols-${colCount}`">
    <div v-for="(media, index) in medias" :key="index" class="p-1">
      <MediaThumbnail
          :src="`${site}/build/media/${media.mediaPath}`"
          :alt="media.mediaPath"
          :lazy-load-trigger="lazyLoadTrigger"
      />
    </div>
  </section>
</template>

<style scoped>

</style>
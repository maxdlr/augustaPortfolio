<script setup>
import MediaThumbnail from "../atom/MediaThumbnail.vue";

const props = defineProps({
  avatarImg: {type: Object, required: true},
  size: {type: [Number, String], default: 200}
})
</script>

<template>
  <div class="d-inline-block">
    <div :style="`margin-top: ${size * 0.25}px !important; margin-left: ${size * 0.25}px !important;`"
         class="position-relative">
      <div
          :style="`width: ${size}px !important; aspect-ratio: 1/1 !important;`"
          class="rounded-circle overflow-hidden">
        <MediaThumbnail :animate="false" :media="avatarImg" class="w-100 z-2"/>
      </div>
      <div
          :style="`width: ${size * 0.75}px !important; aspect-ratio: 1/1 !important; translate: -${size * 0.25}px -${size * 0.25}px !important`"
          class="bg-info rounded-circle position-absolute top-0 start-0"></div>
    </div>
  </div>
</template>

<style scoped>

</style>
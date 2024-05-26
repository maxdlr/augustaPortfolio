<script setup>
import MediaThumbnail from "../atom/MediaThumbnail.vue";
const props = defineProps({
  avatarImg: {type: Object, required: true},
  size: {type: [Number, String], default: 200}
})
</script>

<template>
  <div class="p-4">
    <div class="position-relative"
         :style="`margin: ${size * 0.25}px !important;`">
      <div
          :style="`width: ${size}px !important; aspect-ratio: 1/1 !important;`"
          class="rounded-circle overflow-hidden">
        <MediaThumbnail :media="avatarImg" class="w-100"/>
      </div>
      <div
          class="bg-info rounded-circle position-absolute top-0 start-0 z-n1"
          :style="`width: ${size * 0.75}px !important; aspect-ratio: 1/1 !important; translate: -${size * 0.25}px -${size * 0.25}px !important`"></div>
    </div>
  </div>
</template>

<style scoped>

</style>
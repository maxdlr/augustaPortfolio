<script setup>
import ShowReel from "../components/template/ShowReel.vue";
import HomeMotion from "../components/template/HomeMotion.vue";

const props = defineProps({
  showreelThumbnailPath: {type: String, required: true},
  motionGifs: {type: Object, required:true}
})
</script>

<template>
  <h1 class="fs-title ms-5" style="font-size: 100px !important;">
    <span class="text-primary">augusta</span>
    <span class="text-info">.</span>
    <span class="text-primary">sarlin</span>
  </h1>
  <ShowReel :showreel-thumbnail-path="showreelThumbnailPath"/>
  <HomeMotion :motion-gifs="motionGifs"/>
</template>

<style scoped>

</style>
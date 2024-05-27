<script setup>
import HomeShowReel from "../components/template/HomeShowReel.vue";
import HomeMotion from "../components/template/HomeMotion.vue";
import HomeIllustration from "../components/template/HomeIllustration.vue";
import HomeAbout from "../components/template/HomeAbout.vue";

const props = defineProps({
  showreelThumbnailPath: {type: String, required: true},
  motionGifs: {type: Object, required:true},
  illustrationImgs: {type: Object, required:true},
  avatarImg: {type: Object, required:true},
})
</script>

<template>
  <h1 class="fs-title ms-5" style="font-size: 100px !important;">
    <span class="text-primary">augusta</span>
    <span class="text-info">.</span>
    <span class="text-primary">sarlin</span>
  </h1>
  <HomeShowReel :showreel-thumbnail-path="showreelThumbnailPath"/>
  <HomeMotion :motion-gifs="motionGifs"/>
  <HomeIllustration :illustration-imgs="illustrationImgs" />
  <HomeAbout :avatar-img="avatarImg"/>
</template>

<style scoped>

</style>
<script setup>
import HomeShowReel from "../components/template/HomeShowReel.vue";
import HomeMotion from "../components/template/HomeMotion.vue";
import HomeIllustration from "../components/template/HomeIllustration.vue";
import HomeAbout from "../components/template/HomeAbout.vue";
import HomeTitle from "./HomeTitle.vue";

const props = defineProps({
  showreelThumbnailPath: {type: String, required: true},
  motionGifs: {type: Object, required: true},
  illustrationImgs: {type: Object, required: true},
  avatarImg: {type: Object, required: true},
  interventions: {type: Object},
  experiences: {type: Object},
  skills: {type: Object},
  meuf: {type: Object}
})
</script>

<template>
  <HomeTitle/>
  <HomeShowReel
      :showreel-thumbnail-path="showreelThumbnailPath"
      anchor="showreel"
  />
  <HomeMotion
      :motion-gifs="motionGifs"
      anchor="motion"
  />
  <HomeIllustration
      :illustration-imgs="illustrationImgs"
      anchor="illustration"
  />
  <HomeAbout
      :avatar-img="avatarImg"
      :experiences="experiences"
      :interventions="interventions"
      :meuf="meuf"
      :skills="skills"
      anchor="about"
  />
</template>
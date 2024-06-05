<script setup>
import HomeShowReel from "../components/template/HomeShowReel.vue";
import HomeMotion from "../components/template/HomeMotion.vue";
import HomeIllustration from "../components/template/HomeIllustration.vue";
import HomeAbout from "../components/template/HomeAbout.vue";
import {goTo} from "../composable/action/redirect";

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
  <h1 class="ms-md-5 text-md-start text-center d-inline-block" role="button" style="font-size: 4vw !important;"
      @click.prevent="goTo('/')">
    <span class="fs-title text-primary">augusta</span>
    <span class="text-info">.</span>
    <span class="fs-title text-primary">sarlin</span>
  </h1>
  <div class="text-end pe-5 d-md-none">
    <span class="fst-italic text-secondary">Freelance 🤙 from Lyon with ❤️</span>
  </div>
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

<style scoped>

</style>
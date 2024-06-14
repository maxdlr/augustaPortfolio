<script setup>
import HomeShowReel from "../components/template/HomeShowReel.vue";
import HomeMotion from "../components/template/HomeMotion.vue";
import HomeIllustration from "../components/template/HomeIllustration.vue";
import HomeAbout from "../components/template/HomeAbout.vue";
import HomeContact from "../components/template/HomeContact.vue";
import HomeTitle from "../components/atom/HomeTitle.vue";
import HomeFooter from "../components/template/HomeFooter.vue";
import NavBarDesktop from "../components/atom/NavBarDesktop.vue";
import {computed} from "vue";

const props = defineProps({
  showreelThumbnailPath: {type: String, required: true},
  showreelVideoId: {type: Object, required: true},
  motionGifs: {type: Object, required: true},
  illustrationImgs: {type: Object, required: true},
  avatarImg: {type: Object, required: true},
  interventions: {type: Object},
  experiences: {type: Object},
  skills: {type: Object},
  meuf: {type: Object},
  contactImgs: {type: Object},
  socialItems: {type: Object}
})

</script>

<template>
  <HomeTitle/>
  <HomeShowReel
      v-if="showreelThumbnailPath && showreelVideoId"
      :is-top-bar-active="socialItems !== null"
      :showreel-thumbnail-path="showreelThumbnailPath"
      :showreel-video-id="showreelVideoId.mediaPath"
      anchor="showreel"
  />
  <HomeMotion
      v-if="motionGifs"
      :is-top-bar-active="socialItems !== null"
      :motion-gifs="motionGifs"
      anchor="motion"
  />
  <HomeIllustration
      v-if="illustrationImgs"
      :illustration-imgs="illustrationImgs"
      :is-top-bar-active="socialItems !== null"
      anchor="illustration"
  />
  <HomeAbout
      v-if="experiences || interventions || skills"
      :avatar-img="avatarImg"
      :experiences="experiences"
      :interventions="interventions"
      :is-top-bar-active="socialItems !== null"
      :meuf="meuf"
      :skills="skills"
      anchor="about"
  />
  <HomeContact
      :contact-imgs="contactImgs"
      :is-top-bar-active="socialItems !== null"
      anchor="contact"
  />
  <HomeFooter/>
</template>
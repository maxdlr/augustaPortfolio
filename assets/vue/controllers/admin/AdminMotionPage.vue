<script setup>
import MediaGallery from "../../components/molecule/MediaGallery.vue";
import Button from "../components/Button.vue";

const props = defineProps({
  motionGifs: {type: Object, required: true}
})

</script>

<template>
  <MediaGallery
      :admin="true"
      :buttons="true"
      :ignore-hash="true"
      :is-on-mobile="false"
      :medias="motionGifs"
      gallery-name="adminMotion"
      lazy-load-trigger="hover"
      start-media-count="all"
  />
</template>

<style scoped>

</style>
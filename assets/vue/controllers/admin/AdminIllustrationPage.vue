<script setup>
import MediaGallery from "../../components/molecule/MediaGallery.vue";

const props = defineProps({
  illustrationImgs: {type: Object, required: true}
})

</script>

<template>
  <MediaGallery
      :admin="true"
      :buttons="true"
      :ignore-hash="true"
      :is-on-mobile="false"
      :medias="illustrationImgs"
      gallery-name="adminIllustration"
      start-media-count="all"
  />
</template>
<style scoped>

</style>
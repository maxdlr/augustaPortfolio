<script setup>
import MediaGallery from "../../components/molecule/MediaGallery.vue";
import HelpBox from "../../components/atom/HelpBox.vue";

const props = defineProps({
  illustrationImgs: {type: Object, required: true}
})

</script>

<template>
  <HelpBox
      :instructions="[
      'Acceptés: .jpeg, .png, .webp, .gif',
      'Les 6 derniers uploadés sont celles affichées au chargement de la page d\'accueil.'
  ]"
      class="mt-3"/>
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
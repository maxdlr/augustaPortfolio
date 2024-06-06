<script setup>
import MediaGallery from "../../components/molecule/MediaGallery.vue";
import Button from "../components/Button.vue";
import HelpBox from "../../components/atom/HelpBox.vue";

const props = defineProps({
  motionGifs: {type: Object, required: true}
})

</script>

<template>
  <HelpBox
      :instructions="[
      'Acceptés: .jpeg, .png, .webp, .gif',
      'Tu peux uploader tout d\'un coup, si le total fait moins de 50 mo',
      'Les 6 derniers uploadés sont celles affichées au chargement de la page d\'accueil.'
  ]"
      class="mt-3"/>
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

<style lang="scss" scoped>

</style>
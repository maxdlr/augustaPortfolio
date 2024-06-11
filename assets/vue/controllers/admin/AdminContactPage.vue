<script setup>
import MediaGallery from "../../components/molecule/MediaGallery.vue";
import HelpBox from "../../components/atom/HelpBox.vue";

const props = defineProps({
  contactImgs: {type: Object, required: true}
})

</script>

<template>
  <HelpBox
      :instructions="[
      'Acceptés: .jpeg, .png, .webp, .gif',
      '3 images maximum (tu peux uploader les 3 en meme temps)',
      'Si tu en mets plus que 3, il prendra les 3 plus récentes en date d\'upload.',
      'Essaye de ne pas en laisser trainer, pour ne pas alourdir la page.'
  ]"
      class="mt-3"/>
  <MediaGallery
      :admin="true"
      :buttons="true"
      :ignore-hash="true"
      :is-on-mobile="false"
      :medias="contactImgs"
      gallery-name="adminContact"
      start-media-count="all"
  />
</template>
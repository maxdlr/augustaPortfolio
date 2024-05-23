<script setup>
import MediaGallery from "../../components/molecule/MediaGallery.vue";
import Button from "../components/Button.vue";

const props = defineProps({
  motionGifs: {type: Object, required: true}
})

</script>

<template>
  <MediaGallery :medias="motionGifs" lazy-load-trigger="hover" :buttons="true"/>
</template>

<style scoped>

</style>
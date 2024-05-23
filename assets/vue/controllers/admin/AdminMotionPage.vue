<script setup>
import MediaGallery from "../../components/molecule/MediaGallery.vue";

const props = defineProps({
  motionGifs: {type: Object, required: true}
})

</script>

<template>
<MediaGallery :medias="motionGifs" lazy-load-trigger="hover"/>
</template>

<style scoped>

</style>
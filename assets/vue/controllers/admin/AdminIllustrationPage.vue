<script setup>
import MediaGallery from "../../components/molecule/MediaGallery.vue";

const props = defineProps({
  illustrationImgs: {type: Object, required: true}
})

</script>

<template>
<MediaGallery :medias="illustrationImgs" :buttons="true" gallery-name="adminIllustration" :ignore-hash="true"/>
</template>
<style scoped>

</style>
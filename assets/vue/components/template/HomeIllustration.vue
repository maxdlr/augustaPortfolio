<script setup>
import BaseTemplate from "../atom/BaseTemplate.vue";
import MediaGallery from "../molecule/MediaGallery.vue";

const props = defineProps({
  illustrationImgs: {type: Object, required: true}
})

const site = window.location.origin;

</script>

<template>
  <div id="illustration"></div>
<BaseTemplate>
  <template #context>
    <div class="fs-1">
      <div>
        <span class="text-secondary">Illustration</span>
        <span class="text-info">.</span>
      </div>
      <div>
        <span class="text-info">Flat design </span>
        <span class="text-secondary">& </span>
        <span class="text-primary">colors</span>
      </div>
    </div>
  </template>
  <template #content>
    <MediaGallery :medias="illustrationImgs" col-count="3" gallery-name="homeIllustration"/>
  </template>
</BaseTemplate>
</template>

<style scoped>

</style>
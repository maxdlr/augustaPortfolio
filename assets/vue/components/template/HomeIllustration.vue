<script setup>
import HomeGalleryTemplate from "../molecule/HomeGalleryTemplate.vue";

const props = defineProps({
  illustrationImgs: {type: Object, required: true},
  anchor: {type: String, required: true},
  isTopBarActive: {type: Boolean}
})
</script>

<template>
  <HomeGalleryTemplate
      :anchor="anchor"
      :is-top-bar-active="isTopBarActive"
      :medias="illustrationImgs"
      gallery-name="homeIllustration"
  >

    <template #title>
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
  </HomeGalleryTemplate>
</template>
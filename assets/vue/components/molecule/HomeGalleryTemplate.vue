<script setup>
import BaseTemplate from "../atom/BaseTemplate.vue";
import MediaGallery from "../molecule/MediaGallery.vue";
import {BREAKPOINTS} from "../../constant/bootstrap-constants";
import {ref} from "vue";

const props = defineProps({
  media: {type: Object, required: true},
  galleryName: {type: String, required: true},
  anchor: {type: String, required: true},
  lazyLoadTrigger: {
    type: [String, Boolean], default: false, required: false, validator(value) {
      return ['hover', 'click', false].includes(value)
    }
  },
})

const isShowingAllMedia = ref(false);
const showOnlyMedia = () => {
  isShowingAllMedia.value = true;
}

const showDefaultLayout = () => {
  isShowingAllMedia.value = false;
}

</script>

<template>
  <BaseTemplate
      :anchor="anchor"
      :cols="isShowingAllMedia ? [0, 12] : [5, 7]"
      :content-flex="{justify: {md: 'center'}, align: {md: 'start'}}"
  >
    <template #context="{screenWidth, screenHeight}">
      <slot :screenHeight="screenHeight" :screenWidth="screenWidth" name="title"/>
    </template>
    <template #content="{screenWidth}">
      <MediaGallery
          :col-count="isShowingAllMedia ? 6 : 3"
          :gallery-name="galleryName"
          :is-on-mobile="screenWidth < BREAKPOINTS.MD"
          :medias="media"
          start-media-count="6"
          @all-shown="showOnlyMedia"
          @less-shown="showDefaultLayout"
      />
    </template>
  </BaseTemplate>
</template>

<style scoped>

</style>
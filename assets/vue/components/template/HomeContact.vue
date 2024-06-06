<script setup>
import HomeGalleryTemplate from "../molecule/HomeGalleryTemplate.vue";
import BaseTemplate from "../atom/BaseTemplate.vue";
import MediaThumbnail from "../atom/MediaThumbnail.vue";

const props = defineProps({
  contactImgs: {type: Object, required: true},
  anchor: {type: String, required: true}
})

</script>

<template>
  <div class="pb-5">
    <BaseTemplate :anchor="anchor" :cols="[3, 9]" :context-flex="{justify: {md: 'center'}, align: {md: 'start'}}">
      <template #context>
        <div class="fs-2 ">
          <div>
            <span class="text-secondary">Un projet</span>
            <span class="text-info"> ?</span>
          </div>
          <a href="mailto:augusta@qimono.tv">
            <div class="text-nowrap">
              <span class="text-primary">On en parle </span>
              <span class="text-secondary"> ici ❤️</span>
            </div>
          </a>
        </div>
      </template>
      <template v-if="contactImgs" #content>
        <div class="py-5 mb-5 py-lg-0 d-flex justify-content-center align-items-center">
          <div class="rotateContactStart">
            <MediaThumbnail :media="contactImgs[0]"/>
          </div>
          <div class="z-2">
            <MediaThumbnail :media="contactImgs[1]"/>
          </div>
          <div class="rotateContactEnd">
            <MediaThumbnail :media="contactImgs[2]"/>
          </div>
        </div>
      </template>
    </BaseTemplate>
  </div>
</template>

<style lang="scss" scoped>

.rotateContactStart {
  transform: translate(20%, 5%) rotate(-10deg) !important;
}

.rotateContactEnd {
  transform: translate(-20%, 5%) rotate(10deg) !important;
}

</style>